<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanTransaksi;
use App\Models\Transaksi;
use App\Models\Produk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class LaporanTransaksiController extends Controller
{
   
     public function index(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $laporantransaksi = LaporanTransaksi::with(['transaksi', 'produk'])
            ->when($bulan, function ($query) use ($bulan) {
                $query->whereMonth('created_at', $bulan);
            })
            ->when($tahun, function ($query) use ($tahun) {
                $query->whereYear('created_at', $tahun);
            })
            ->get();

        $transaksi = Transaksi::all();
        $produk = Produk::all();

        return view('admin.laporantransaksi', [
            'laporantransaksi' => $laporantransaksi,
            'transaksi' => $transaksi,
            'produk' => $produk,
            'search' => $request->input('search'), // jika ada search input
        ]);
    }

    public function exportPdf(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Ambil data dengan filter bulan & tahun yang sama seperti di index
        $laporantransaksi = LaporanTransaksi::with(['transaksi', 'produk'])
            ->when($bulan, function ($query) use ($bulan) {
                $query->whereMonth('created_at', $bulan);
            })
            ->when($tahun, function ($query) use ($tahun) {
                $query->whereYear('created_at', $tahun);
            })
            ->get();

        // Render view PDF, buat file blade baru khusus PDF atau reuse blade yang ada tapi minimalis
        $pdf = Pdf::loadView('admin.laporantransaksi_pdf', compact('laporantransaksi', 'bulan', 'tahun'));

        // Jika mau langsung download:
        return $pdf->download('laporan_transaksi_'.$tahun.'_'.$bulan.'.pdf');

        // Kalau mau langsung buka di browser:
        // return $pdf->stream('laporan_barang_'.$tahun.'_'.$bulan.'.pdf');
    }

    // Tampilkan detail laporan berdasarkan id
    public function show($id)
    {
        $laporantransaksi = LaporanTransaksi::with([
            'transaksi',
            'produk'
        ])->find($id);

        if (!$laporantransaksi) {
            return redirect()->route('laporantransaksi')->with('error', 'Laporan tidak ditemukan.');
        }

        // Kirim variabel $laporanbarang ke view, bisa juga kasih alias $laporan
        return view('admin.detail_laporantransaksi', compact('laporantransaksi'));
    }

  
    public function exportPdfDetail($id)
    {
        $laporantransaksi = LaporanTransaksi::with([
            'transaksi',
            'produk'
        ])->findOrFail($id);

        $pdf = Pdf::loadView('admin.laporantransaksi_pdf_detail', compact('laporantransaksi'));

        return $pdf->download('laporan_transaksi_detail_'.$laporantransaksi->Idlaporan_transaksi.'.pdf');
    }

    public function destroy($id)
    {
        $laporantransaksi = LaporanTransaksi::find($id);

        if (!$laporantransaksi) {
            return redirect()->route('laporantransaksi')->with('Gagal', 'Data tidak ditemukan.');
        }

        $laporantransaksi->delete();

        return redirect()->route('laporantransaksi')->with('Sukses', 'Data berhasil dihapus.');
    }
}
