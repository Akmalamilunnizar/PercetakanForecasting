<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Anda mungkin tidak memerlukan ini jika tidak berinteraksi langsung dengan model User di controller ini
use App\Models\Transaksi; // Pastikan model ini benar
use Illuminate\Support\Facades\Validator; // Anda mungkin tidak memerlukan ini jika tidak ada validasi di sini
use Illuminate\Support\Facades\DB; // Anda mungkin tidak memerlukan ini jika tidak ada query DB mentah di sini

class TransaksiController extends Controller
{
    public function index()
    {
        // Ambil data transaksi
        // Pastikan relasi 'detail' ada di model Transaksi dan mengarah ke customer
        // Eager load 'detail' untuk menghindari N+1 query problem
        $transaksi = Transaksi::with('detail')->get();

        // Kirim data ke view
        return view("admin.allTransaksi", compact('transaksi'));
    }

    /**
     * Metode untuk menerima orderan transaksi.
     *
     * @param int $id ID dari transaksi yang akan diterima.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function terimaOrderan($id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            // Jika transaksi tidak ditemukan, redirect dengan pesan error
            return redirect()->route('alltransaksi')->with('error', 'Transaksi tidak ditemukan.');
        }

        // Ubah status pesanan menjadi 'Diterima'
        $transaksi->StatusPesanan = 'Diterima';
        $transaksi->save();

        // Redirect kembali ke halaman daftar transaksi dengan pesan sukses
        return redirect()->route('alltransaksi')->with('message', 'Orderan berhasil diterima!');
    }

    /**
     * Metode untuk menolak orderan transaksi.
     *
     * @param int $id ID dari transaksi yang akan ditolak.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function tolakOrderan($id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            // Jika transaksi tidak ditemukan, redirect dengan pesan error
            return redirect()->route('alltransaksi')->with('error', 'Transaksi tidak ditemukan.');
        }

        // Ubah status pesanan menjadi 'Ditolak'
        $transaksi->StatusPesanan = 'Ditolak';
        $transaksi->save();

        // Redirect kembali ke halaman daftar transaksi dengan pesan sukses
        return redirect()->route('alltransaksi')->with('message', 'Orderan berhasil ditolak!');
    }

    // Jika Anda memiliki metode pencarian untuk transaksi, tambahkan di sini
    public function SearchTransaksi(Request $request)
    {
        $search = $request->input('search');

        $transaksi = Transaksi::query()
            ->when($search, function ($query, $search) {
                $query->where('IdTransaksi', 'like', "%{$search}%")
                      ->orWhereHas('detail', function ($query) use ($search) {
                          // Asumsi 'detail' adalah relasi ke model customer,
                          // dan customer memiliki kolom 'f_name' atau nama lain yang relevan
                          $query->where('f_name', 'like', "%{$search}%");
                      });
            })
            ->with('detail') // Eager load detail juga untuk hasil pencarian
            ->get();

        return view('admin.allTransaksi', compact('transaksi', 'search'));
    }

    // ... metode lain jika ada (ManageTransaksi, AddTransaksi, StoreTransaksi, EditTransaksi, UpdateTransaksi, DeleteTransaksi)
}