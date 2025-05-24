<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\DB; // Untuk query database
use Illuminate\Support\Facades\Storage; // Untuk menghapus file gambar

class ProdukController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $dataProduk = Produk::all();
        return view('admin.allproduk', compact('dataProduk'));
    }

    // Menampilkan form tambah produk
    public function addProduk()
    {
        // Ambil ID produk terakhir dari database
        $lastProduk = Produk::orderBy('IdProduk', 'desc')->first();
        $newId = $lastProduk ? 'P' . str_pad((substr($lastProduk->IdProduk, 1) + 1), 4, '0', STR_PAD_LEFT) : 'P0001';

        // Kirim variabel newId ke view
        return view('admin.addproduk', compact('newId'));
    }

    // Menyimpan produk baru
    public function storeProduk(Request $request)
    {
        // Validasi input
        $request->validate([
            'NamaProduk' => 'required',
            'HargaProduk' => 'required|numeric',
            'ukuran_produk' => 'nullable|string|max:255', // Add validation for new fields
            'jenis_bahan_produk' => 'nullable|string|max:255',
            'custom_produk' => 'nullable|string|max:255',
            'diskon' => 'nullable|numeric',
            'Img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Ambil ID produk terakhir dari database
        $lastProduk = Produk::orderBy('IdProduk', 'desc')->first();
        $newId = $lastProduk ? 'P' . str_pad((substr($lastProduk->IdProduk, 1) + 1), 4, '0', STR_PAD_LEFT) : 'P0001';

        // Upload gambar
        $path = $request->file('Img')->store('produk', 'public');

        $ukuranProduk = $request->ukuran_produk;
        // Jika field kosong atau null, berikan nilai default
        if (empty($ukuranProduk)) {
            $ukuranProduk = 'Tidak Ada Ukuran'; // Atau 'N/A', 'Ukuran Default', dll.
        }
        // Simpan data produk ke database
        Produk::create([
            'IdProduk' => $newId, // ID produk otomatis
            'NamaProduk' => $request->NamaProduk,
            'HargaProduk' => $request->HargaProduk,
            'ukuran_produk' =>$ukuranProduk, // Save new field
            'jenis_bahan_produk' => $request->jenis_bahan_produk, // Save new field
            'custom_produk' => $request->custom_produk, // Save new field
            'diskon' => $request->diskon, // Save new field
            'Img' => $path, // Menyimpan path gambar
        ]);

        return redirect()->route('allproduk')->with('message', 'Produk berhasil ditambahkan!');
    }

    // Menampilkan form edit produk
    public function editProduk($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.editproduk', compact('produk'));
    }

    // Memperbarui data produk
    public function updateProduk(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        // --- DEBUGGING STEP 1: Lihat semua data yang diterima dari form ---
        // dd($request->all()); // Uncomment baris ini untuk melihat semua data request
        // Validasi input
        $request->validate([
            'NamaProduk' => 'required',
            'HargaProduk' => 'required|numeric',
            'ukuran_produk' => 'nullable|string|max:255',
            'jenis_bahan_produk' => 'nullable|string|max:255',
            'custom_produk' => 'nullable|string|max:255',
            'diskon' => 'nullable|numeric',
            'Img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Inisialisasi variabel dengan nilai dari request
        $ukuranProduk = $request->ukuran_produk;
        $jenisBahanProduk = $request->jenis_bahan_produk;
        $customProduk = $request->custom_produk;

        // Terapkan nilai default jika kosong
        if (empty($ukuranProduk)) {
            $ukuranProduk = 'Tidak Ada Ukuran';
        }
        if (empty($jenisBahanProduk)) {
            $jenisBahanProduk = 'Tidak Ada Jenis Bahan';
        }
        if (empty($customProduk)) {
            $customProduk = 'Tidak Ada Kustomisasi';
        }

        // --- DEBUGGING STEP 2: Lihat nilai variabel setelah diolah ---
        // dd([
        //     'ukuran_produk_final' => $ukuranProduk,
        //     'jenis_bahan_produk_final' => $jenisBahanProduk,
        //     'custom_produk_final' => $customProduk,
        // ]);


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
            'ukuran_produk' => $ukuranProduk,
            'jenis_bahan_produk' => $jenisBahanProduk,
            'custom_produk' => $customProduk,
            'diskon' => $request->diskon,
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
        $produk = Produk::all();
        return response()->json($produk, 200);
    }

    // Fitur pencarian produk (opsional)
    public function searchProduk(Request $request)
    {
        $search = $request->search;

        $produk = Produk::where(function ($query) use ($search) {
            $query->where('IdProduk', 'like', "%$search%")
                ->orWhere('NamaProduk', 'like', "%$search%")
                ->orWhere('HargaProduk', 'like', "%$search%")
                ->orWhere('ukuran_produk', 'like', "%$search%") // Add search for new fields
                ->orWhere('jenis_bahan_produk', 'like', "%$search%")
                ->orWhere('custom_produk', 'like', "%$search%")
                ->orWhere('diskon', 'like', "%$search%");
        })->get();

        return view('admin.allproduk', compact('produk', 'search'));
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