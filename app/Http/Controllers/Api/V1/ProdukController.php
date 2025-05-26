<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Items;
use App\Models\Diskon;
use App\Models\Size;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $dataProduk = Produk::with(['bahan', 'diskonRelasi', 'size'])->get();
        return view('admin.allproduk', compact('dataProduk'));
    }

    // Menampilkan form tambah produk
    public function addProduk()
    {
        // Ambil ID produk terakhir dari database
        $lastProduk = Produk::orderBy('IdProduk', 'desc')->first();
        $newId = $lastProduk ? 'P' . str_pad((substr($lastProduk->IdProduk, 1) + 1), 4, '0', STR_PAD_LEFT) : 'P0001';

        // Ambil data bahan, diskon, dan ukuran untuk dropdown
        $bahanList = Items::all();
        $diskonList = Diskon::all();
        $sizeList = Size::all();

        return view('admin.addproduk', compact('newId', 'bahanList', 'diskonList', 'sizeList'));
    }

    // Menyimpan produk baru
    public function storeProduk(Request $request)
    {
        // Validasi input
        $request->validate([
            'NamaProduk' => 'required',
            'HargaProduk' => 'required|numeric',
            'ukuran' => 'nullable|exists:size,id_ukuran',
            'bahan' => 'nullable|string|max:100',
            'custom' => 'nullable|string|max:100',
            'diskon' => 'nullable|exists:diskon,id',
            'id_bahan' => 'nullable|exists:databarang,IdBarang',
            'Img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'required|string|max:1500',
        ]);

        // Ambil ID produk terakhir dari database
        $lastProduk = Produk::orderBy('IdProduk', 'desc')->first();
        $newId = $lastProduk ? 'P' . str_pad((substr($lastProduk->IdProduk, 1) + 1), 4, '0', STR_PAD_LEFT) : 'P0001';

        // Upload gambar
        $path = $request->file('Img')->store('produk', 'public');

        // Simpan data produk ke database
        Produk::create([
            'IdProduk' => $newId,
            'NamaProduk' => $request->NamaProduk,
            'HargaProduk' => $request->HargaProduk,
            'ukuran' => $request->ukuran,
            'bahan' => $request->bahan,
            'custom' => $request->custom,
            'diskon' => $request->diskon,
            'id_bahan' => $request->id_bahan,
            'Img' => $path,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('allproduk')->with('message', 'Produk berhasil ditambahkan!');
    }

    // Menampilkan form edit produk
    public function editProduk($id)
    {
        $produk = Produk::with(['bahan', 'diskonRelasi', 'size'])->findOrFail($id);
        $bahanList = Items::all();
        $diskonList = Diskon::all();
        $sizeList = Size::all();
        return view('admin.editproduk', compact('produk', 'bahanList', 'diskonList', 'sizeList'));
    }

    // Memperbarui data produk
    public function updateProduk(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        // Validasi input
        $request->validate([
            'NamaProduk' => 'required',
            'HargaProduk' => 'required|numeric',
            'ukuran' => 'nullable|exists:size,id_ukuran',
            'bahan' => 'nullable|string|max:100',
            'custom' => 'nullable|string|max:100',
            'diskon' => 'nullable|exists:diskon,id',
            'id_bahan' => 'nullable|exists:databarang,IdBarang',
            'Img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'required|string|max:1500',
        ]);

        // Jika gambar baru diupload
        if ($request->hasFile('Img')) {
            if ($produk->Img && Storage::disk('public')->exists($produk->Img)) {
                Storage::disk('public')->delete($produk->Img);
            }
            $path = $request->file('Img')->store('produk', 'public');
            $produk->Img = $path;
        }

        // Update data produk
        $produk->update([
            'NamaProduk' => $request->NamaProduk,
            'HargaProduk' => $request->HargaProduk,
            'ukuran' => $request->ukuran,
            'bahan' => $request->bahan,
            'custom' => $request->custom,
            'diskon' => $request->diskon,
            'id_bahan' => $request->id_bahan,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('allproduk')->with('message', 'Produk berhasil diperbarui!');
    }

    // Menghapus produk
    public function deleteProduk($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus gambar jika ada
        if ($produk->Img && Storage::disk('public')->exists($produk->Img)) {
            Storage::disk('public')->delete($produk->Img);
        }

        // Hapus data produk dari database
        $produk->delete();

        return redirect()->route('allproduk')->with('message', 'Produk berhasil dihapus!');
    }

    // Menampilkan list produk dalam format JSON
    public function get_produk_list()
    {
        $produk = Produk::with(['bahan', 'diskonRelasi'])->get();
        return response()->json($produk, 200);
    }

    // Fitur pencarian produk
    public function searchProduk(Request $request)
    {
        $search = $request->search;

        $dataProduk = Produk::with(['bahan', 'diskonRelasi'])
            ->leftJoin('databarang', 'produk.id_bahan', '=', 'databarang.IdBarang')
            ->where(function ($query) use ($search) {
                $query->where('IdProduk', 'like', "%$search%")
                    ->orWhere('NamaProduk', 'like', "%$search%")
                    ->orWhere('HargaProduk', 'like', "%$search%")
                    ->orWhere('ukuran', 'like', "%$search%")
                    ->orWhere('id_bahan', 'like', "%$search%")
                    ->orWhere('deskripsi', 'like', "%$search%")
                    ->orWhere('databarang.NamaBarang', 'like', "%$search%");
            })
            ->select('produk.*')
            ->get();

        return view('admin.allproduk', compact('dataProduk', 'search'));
    }

    // This method seems out of place for a ProdukController and refers to a Supplier model.
    // I've kept it as is, but you might want to move it to a SupplierController if it's meant for that.
    public function destroy($id)
    {
        $supplier = Supplier::find($id); // Assuming Supplier model is imported or in the same namespace

        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        $supplier->delete();

        return response()->json(['message' => 'Supplier deleted successfully'], 200);
    }
}