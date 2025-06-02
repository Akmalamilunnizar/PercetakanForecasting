<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        $query = Transaksi::query();

        // Filter jika ada bulan
        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        // Filter jika ada tahun
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        $transaksi = $query->orderBy('created_at', 'desc')->get();

        return view('admin.allTransaksi', compact('transaksi', 'bulan', 'tahun'));
    }

    public function exportPdf(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        $query = Transaksi::query();

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        $transaksis = $query->orderBy('created_at', 'asc')->get();

        $pdf = Pdf::loadView('admin.transaksi_pdf', compact('transaksis', 'bulan', 'tahun'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('laporan-transaksi.pdf');
    }
}

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