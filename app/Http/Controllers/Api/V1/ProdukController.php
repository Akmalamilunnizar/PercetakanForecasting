<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\DB; // Untuk query database

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
            'Img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Ambil ID produk terakhir dari database
        $lastProduk = Produk::orderBy('IdProduk', 'desc')->first();
        $newId = $lastProduk ? 'P' . str_pad((substr($lastProduk->IdProduk, 1) + 1), 4, '0', STR_PAD_LEFT) : 'P0001';

        // Upload gambar
        $path = $request->file('Img')->store('produk', 'public');

        // Simpan data produk ke database
        Produk::create([
            'IdProduk' => $newId, // ID produk otomatis
            'NamaProduk' => $request->NamaProduk,
            'HargaProduk' => $request->HargaProduk,
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

        // Validasi input
        $request->validate([
            'NamaProduk' => 'required',
            'HargaProduk' => 'required|numeric',
        ]);

        // Jika gambar baru diupload
        if ($request->hasFile('Img')) {
            $request->validate([
                'Img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Hapus gambar lama jika ada
            if ($produk->Img && file_exists(storage_path('app/public/' . $produk->Img))) {
                unlink(storage_path('app/public/' . $produk->Img));
            }

            // Upload gambar baru
            $path = $request->file('Img')->store('produk', 'public');
            $produk->Img = $path;
        }

        // Update data produk
        $produk->update([
            'NamaProduk' => $request->NamaProduk,
            'HargaProduk' => $request->HargaProduk,
            'Img' => $produk->Img, // Gambar tetap yang lama atau yang baru
        ]);

        return redirect()->route('allproduk')->with('message', 'Produk berhasil diperbarui!');
    }

    // Menghapus produk
    public function deleteProduk($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus gambar jika ada
        if ($produk->Img && file_exists(storage_path('app/public/' . $produk->Img))) {
            unlink(storage_path('app/public/' . $produk->Img));
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
                  ->orWhere('HargaProduk', 'like', "%$search%");
        })->get();

        return view('admin.allproduk', compact('produk', 'search'));
    }
    public function destroy($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        $supplier->delete();

        return response()->json(['message' => 'Supplier deleted successfully'], 200);
    }

}
