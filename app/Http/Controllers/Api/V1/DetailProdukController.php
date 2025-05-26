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
        $produk = DB::table('produk')->where('IdProduk', $id)->first();

        if (!$produk) {
            abort(404);
        }

        $hargaAsli = $produk->HargaProduk;
        $diskonPersen = $produk->diskon ?? 0;
        $hargaSetelahDiskon = $hargaAsli - ($hargaAsli * ($diskonPersen / 100));

        // Ambil dan olah ukuran produk dari semua data
        $ukuranProduk = DB::table('produk')
            ->whereNotNull('ukuran_produk')
            ->where('ukuran_produk', '!=', '0')
            ->pluck('ukuran_produk')
            ->toArray();

        $ukuranList = collect($ukuranProduk)
            ->flatMap(fn($item) => explode(',', $item))
            ->map(fn($item) => trim($item))
            ->unique()
            ->values()
            ->toArray();

        return view('admin.DetailProduk', [
            'produk' => $produk,
            'hargaSetelahDiskon' => $hargaSetelahDiskon,
            'ukuranList' => $ukuranList // <-- KIRIM ke View
        ]);
    }


    public function create()
    {
        $ukuranProduk = DB::table('produk')
            ->whereNotNull('ukuran_produk')
            ->where('ukuran_produk', '!=', '0')
            ->pluck('ukuran_produk')
            ->toArray();

        $ukuranList = collect($ukuranProduk)
            ->flatMap(function ($item) {
                return explode(',', $item);
            })
            ->map(fn($item) => trim($item))
            ->unique()
            ->values()
            ->toArray();

        return view('admin.addproduk', compact('ukuranList'));
    }
}