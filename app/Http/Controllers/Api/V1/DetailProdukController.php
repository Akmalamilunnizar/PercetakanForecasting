<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB; // Jika Anda menggunakan Query Builder

class DetailProdukController extends Controller
{
    public function show(string $id): View
{
    // Asumsi nama tabel produk Anda adalah 'produk'
    $produk = DB::table('produk')->where('IdProduk', $id)->first();

    if (!$produk) {
        // Handle jika produk tidak ditemukan, misalnya redirect atau tampilkan error
        abort(404);
    }

    $hargaAsli = $produk->HargaProduk;
        $diskonPersen = $produk->diskon ?? 0; // Gunakan 0 jika diskon null
        $hargaSetelahDiskon = $hargaAsli - ($hargaAsli * ($diskonPersen / 100));

        // Kirim data produk dan harga setelah diskon ke view
        return view('admin.DetailProduk', [
            'produk' => $produk,
            'hargaSetelahDiskon' => $hargaSetelahDiskon,
        ]);
}
}