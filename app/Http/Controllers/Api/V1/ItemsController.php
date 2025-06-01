<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\DetailMasuk;
use App\Models\BarangMasuk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\TypeItems;
use App\Models\Satuan;
use App\Models\Supplier;
use App\Models\Items;
use Illuminate\Validation\Rule;
use Encore\Admin\Layout\Content;


class ItemsController extends Controller
{
    public function Index()
    {
        // Get all items
        $items = Items::with(['jenisBarang', 'satuan'])->get();

        // Manually load the latest detailBarangMasuk and detailBarangKeluar for each item
        foreach ($items as $item) {
            $item->latestDetailMasuk = DetailMasuk::where('IdBarang', $item->IdBarang)
                ->orderBy('created_at', 'desc')
                ->first();
            // Penting: Pastikan Anda juga memuat relasi supplier di sini jika ingin menggunakannya
            if ($item->latestDetailMasuk) {
                $item->latestDetailMasuk->load('supplier');
            }

            $item->latestDetailKeluar = DB::table('detail_barangkeluar')
                ->where('IdBarang', $item->IdBarang)
                ->orderBy('created_at', 'desc')
                ->first();
        }

        // Urutkan koleksi $items berdasarkan tanggal masuk terbaru
        // Jika Anda memiliki 'tglMasuk' di BarangMasuk yang lebih relevan, gunakan itu.
        // Asumsi 'created_at' di DetailMasuk adalah indikator terbaik untuk "terbaru".
        $items = $items->sortByDesc(function ($item) {
            return optional($item->latestDetailMasuk)->created_at;
        });


        // Tetap ambil riwayat stok secara terpisah untuk ditampilkan di tabel bawah.
        $riwayatStok = DB::table('detail_barangmasuk')
            ->join('databarang', 'detail_barangmasuk.IdBarang', '=', 'databarang.IdBarang')
            ->join('barangmasuk', 'detail_barangmasuk.IdMasuk', '=', 'barangmasuk.IdMasuk')
            ->select(
                'detail_barangmasuk.IdMasuk',
                'databarang.NamaBarang',
                'detail_barangmasuk.QtyMasuk',
                'barangmasuk.tglMasuk as tanggal_masuk'
            )
            ->orderBy('barangmasuk.tglMasuk', 'desc')
            ->orderBy('detail_barangmasuk.created_at', 'desc')
            ->get();


        // Kirim kedua data ke view
        return view("admin.allitems", compact('items', 'riwayatStok'));
    }


    public function SearchItem(Request $request)
    {
        $search = $request->search;

        $items = Items::where(function ($query) use ($search) {

            $query->where('id', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%");
        })->get();

        return view('admin.allitems', compact('items', 'search'));
    }

    public function AddItems()
    {
        $username = Auth::user()->username;
        $lastMasuk = DetailMasuk::orderBy('IdMasuk', 'desc')->first();
        $newIdMasuk = $lastMasuk ? 'BM' . str_pad((int) substr($lastMasuk->IdMasuk, 2) + 1, 4, '0', STR_PAD_LEFT) : 'BM0001';
        // dd($username);

        // Ambil ID terakhir dari tabel supplier
        $lastSupplier = Supplier::orderBy('IdSupplier', 'desc')->first();
        $newIdSupplier = $lastSupplier ? 'SP' . str_pad((int) substr($lastSupplier->IdSupplier, 2) + 1, 4, '0', STR_PAD_LEFT) : 'SP0001';

        $suppliers = Supplier::all();
        $typeid = TypeItems::all();
        $typeS = Satuan::all();

        return view("admin.additems", compact('typeid', 'typeS', 'newIdSupplier', 'newIdMasuk', 'typeid', 'typeS', 'suppliers', 'username'));
    }


    public function StoreItem(Request $request)
    {
        $request->validate([
            'IdBarang' => 'required|unique:databarang',
            'NamaBarang' => 'required|unique:databarang',
            'IdJenisBarang' => 'required',
            'IdSatuan' => 'required',
            'IdMasuk' => 'required',
            'username' => 'required',
            'IdSupplier' => 'required',
            'QtyMasuk' => 'required|numeric',
            'HargaSatuan' => 'required|numeric',
            'SubTotal' => 'required|numeric',
        ]);

        // Simpan ke tabel databarang
        Items::insert([
            'IdBarang' => $request->IdBarang,
            'NamaBarang' => $request->NamaBarang,
            'IdJenisBarang' => $request->IdJenisBarang,
            'JumlahStok' => 0, // Tidak perlu diisi karena udah ada trigger sql
            'IdSatuan' => $request->IdSatuan,
        ]);

        // Simpan ke tabel barangmasuk (master transaksi)
        BarangMasuk::insert([
            'IdMasuk' => $request->IdMasuk,
            'username' => $request->username,
            'tglMasuk' => Carbon::now(),
        ]);

        // Simpan ke tabel detail_barangmasuk (detail transaksi)
        DetailMasuk::insert([
            'IdMasuk' => $request->IdMasuk,
            'IdSupplier' => $request->IdSupplier,
            'IdBarang' => $request->IdBarang,
            'QtyMasuk' => $request->QtyMasuk,
            'HargaSatuan' => $request->HargaSatuan,
            'SubTotal' => $request->SubTotal,
        ]);

        return redirect()->route('allitems')->with('message', 'Barang telah berhasil ditambah!');
    }



    public function EditItem($IdBarang)
    {

        $iteminfo = Items::findOrFail($IdBarang);
        $category_parent = $iteminfo->IdJenisBarang;
        // dd($category_parent);
        $parent_title = TypeItems::where('IdJenisBarang', $category_parent)->first();
        $category_parentS = $iteminfo->IdSatuan;
        $parent_titleS = Satuan::where('IdSatuan', $category_parentS)->first();
        // dd($iteminfo);
        $typeid = TypeItems::all();
        $typeS = Satuan::all();

        return view('admin.edititem', compact('iteminfo', 'typeid', 'typeS', 'parent_title', 'parent_titleS'));
    }

    public function UpdateItem(Request $request)
    {
        $itemid = $request->IdBarang;

        $request->validate([
            'NamaBarang' => [
                'required',
                Rule::unique('databarang', 'NamaBarang')->ignore($request->IdBarang, 'IdBarang'),
            ],

            'IdBarang' => 'required',
            'IdJenisBarang' => 'required',
            'IdSatuan' => 'required',
        ]);

        Items::where('IdBarang', $request->IdBarang)->update([
            'NamaBarang' => $request->NamaBarang,
            'IdJenisBarang' => $request->IdJenisBarang,
            'IdSatuan' => $request->IdSatuan,
        ]);

        return redirect()->route('allitems')->with('message', 'Update Informasi Barang Berhasil!');
    }

    public function DeleteItem($IdBarang)
    {
        // Ambil semua IdMasuk yang berkaitan dengan barang ini
        $idMasukList = DetailMasuk::where('IdBarang', $IdBarang)->pluck('IdMasuk');

        // Hapus semua entri detail masuk yang terkait dengan barang ini
        DetailMasuk::where('IdBarang', $IdBarang)->delete();

        // Hapus dari databarang
        Items::where('IdBarang', $IdBarang)->delete();

        // Cek apakah IdMasuk yang tadi sudah tidak digunakan lagi di detail_barangmasuk
        foreach ($idMasukList as $idMasuk) {
            $used = DetailMasuk::where('IdMasuk', $idMasuk)->exists();
            if (!$used) {
                BarangMasuk::where('IdMasuk', $idMasuk)->delete();
            }
        }

        return redirect()->route('allitems')->with('message', 'Penghapusan Barang ');
    }

    public function KeluarBarang()
    {
        $username = Auth::user()->username;
        $lastKeluar = DB::table('barangkeluar')->orderBy('IdKeluar', 'desc')->first();
        $newIdKeluar = $lastKeluar ? 'BK' . str_pad((int) substr($lastKeluar->IdKeluar, 2) + 1, 4, '0', STR_PAD_LEFT) : 'BK0001';

        $items = Items::with('jenisBarang', 'satuan')->get();

        return view('admin.keluaritems', compact('items', 'newIdKeluar', 'username'));
    }

    public function StoreKeluarBarang(Request $request)
    {
        $request->validate([
            'IdKeluar' => 'required',
            'username' => 'required',
            'IdBarang' => 'required',
            'QtyKeluar' => 'required|numeric|min:1',
        ]);

        // Check if stock is sufficient
        $item = Items::findOrFail($request->IdBarang);
        if ($item->JumlahStok < $request->QtyKeluar) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi!');
        }

        // Begin transaction
        DB::beginTransaction();
        try {
            // Insert into barangkeluar
            DB::table('barangkeluar')->insert([
                'IdKeluar' => $request->IdKeluar,
                'username' => $request->username,
                'tglKeluar' => Carbon::now(),
            ]);

            // Insert into detail_barangkeluar
            DB::table('detail_barangkeluar')->insert([
                'IdKeluar' => $request->IdKeluar,
                'IdBarang' => $request->IdBarang,
                'QtyKeluar' => $request->QtyKeluar,
            ]);

            DB::commit();
            return redirect()->route('allitems')->with('message', 'Barang berhasil keluar!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function tambahQty(Request $request)
    {
        $request->validate([
            'IdBarang' => 'required',
            'QtyMasuk' => 'required|integer|min:1',
        ]);

        // Ambil IdMasuk terakhir dari tabel barangmasuk
        $lastMasuk = DB::table('barangmasuk')->orderByDesc('IdMasuk')->first();

        // Buat IdMasuk baru berdasarkan yang terakhir
        $newIdMasuk = $lastMasuk
            ? 'BM' . str_pad((int) substr($lastMasuk->IdMasuk, 2) + 1, 4, '0', STR_PAD_LEFT)
            : 'BM0001';

        // Ambil data detail masuk terakhir untuk IdBarang ini untuk mendapatkan HargaSatuan terbaru
        $latestDetailMasuk = DetailMasuk::where('IdBarang', $request->IdBarang)
            ->orderBy('created_at', 'desc')
            ->first();

        $hargaSatuan = $latestDetailMasuk ? $latestDetailMasuk->HargaSatuan : 0;
        $subTotal = $request->QtyMasuk * $hargaSatuan;

        // Ambil IdSupplier dari detail masuk terakhir, atau gunakan default jika tidak ada
        $idSupplier = $latestDetailMasuk ? $latestDetailMasuk->IdSupplier : 'SP0001';

        // Simpan data ke tabel barangmasuk
        DB::table('barangmasuk')->insert([
            'IdMasuk' => $newIdMasuk,
            'username' => auth()->user()->username ?? 'admin',
            'tglMasuk' => now(),
        ]);

        // Simpan data ke tabel detail_barangmasuk
        DB::table('detail_barangmasuk')->insert([
            'IdMasuk' => $newIdMasuk,
            'IdSupplier' => $idSupplier, // Gunakan IdSupplier yang diambil
            'IdBarang' => $request->IdBarang,
            'QtyMasuk' => $request->QtyMasuk,
            'HargaSatuan' => $hargaSatuan, // Gunakan HargaSatuan yang diambil
            'SubTotal' => $subTotal, // Gunakan SubTotal yang dihitung
        ]);

        return redirect()->back()->with('message', 'Qty berhasil ditambahkan!');
    }



    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Items';

    // /**
    //  * Make a grid builder.
    //  *
    //  * @return Grid
    //  */
    // protected function grid()
    // {
    //     $grid = new Grid(new Food());
    //     $grid->model()->latest();
    //     $grid->column('id', __('Id'));
    //     $grid->column('name', __('Name'));
    //      $grid->column('FoodType.title', __('Category'));
    //     $grid->column('price', __('Price'));
    //     //$grid->column('location', __('Location'));
    //     $grid->column('stars', __('Stars'));
    //     $grid->column('img', __('Thumbnail Photo'))->image('',60,60);
    //     $grid->column('description', __('Description'))->style('max-width:200px;word-break:break-all;')->display(function ($val){
    //         return substr($val,0,30);
    //     });
    //     //$grid->column('total_people', __('People'));
    //    // $grid->column('selected_people', __('Selected'));
    //     $grid->column('created_at', __('Created_at'));
    //     $grid->column('updated_at', __('Updated_at'));

    //     return $grid;
    // }

    // /**
    //  * Make a show builder.
    //  *
    //  * @param mixed $id
    //  * @return Show
    //  */
    // protected function detail($id)
    // {
    //     $show = new Show(Food::findOrFail($id));



    //     return $show;
    // }

    // /**
    //  * Make a form builder.
    //  *
    //  * @return Form
    //  */
    // protected function form()
    // {
    //     $form = new Form(new Food());
    //     $form->text('name', __('Name'));
    //       $form->select('type_id', __('Type_id'))->options((new FoodType())::selectOptions());
    //     $form->number('price', __('Price'));
    //     $form->text('location', __('Location'));
    //     $form->number('stars', __('Stars'));
    //     $form->number('people', __('People'));
    //     $form->number('selected_people', __('Selected'));
    //     $form->image('img', __('Thumbnail'))->uniqueName();
    //     $form->UEditor('description','Description');



    //     return $form;
    // }
}