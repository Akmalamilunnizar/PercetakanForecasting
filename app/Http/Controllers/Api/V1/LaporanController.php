<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Items;
use App\Models\Supplier;
use App\Models\DetailMasuk;
use App\Models\DetailKeluar;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $laporanbarang = Laporan::with(['databarang', 'supplier', 'detailBarangMasuk', 'detailBarangKeluar', 'barangmasuk', 'barangkeluar'])
            ->when($bulan, function ($query) use ($bulan) {
                $query->whereMonth('created_at', $bulan);
            })
            ->when($tahun, function ($query) use ($tahun) {
                $query->whereYear('created_at', $tahun);
            })
            ->get();

        $databarang = Items::all();
        $supplier = Supplier::all();
        $detailBarangMasuk = DetailMasuk::all();
        $detailBarangKeluar = DetailKeluar::all();
        $barangmasuk = BarangMasuk::all();
        $barangkeluar = BarangKeluar::all();

        return view('admin.laporanbarang', [
            'laporanbarang' => $laporanbarang,
            'databarang' => $databarang,
            'supplier' => $supplier,
            'detailBarangMasuk' => $detailBarangMasuk,
            'detailBarangKeluar' => $detailBarangKeluar,
            'barangmasuk' => $barangmasuk,
            'barangkeluar' => $barangkeluar,
            'search' => $request->input('search'), // jika ada search input
        ]);
    }

    public function exportPdf(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Ambil data dengan filter bulan & tahun yang sama seperti di index
        $laporanbarang = Laporan::with(['databarang', 'supplier', 'detailBarangMasuk', 'detailBarangKeluar', 'barangmasuk', 'barangkeluar'])
            ->when($bulan, function ($query) use ($bulan) {
                $query->whereMonth('created_at', $bulan);
            })
            ->when($tahun, function ($query) use ($tahun) {
                $query->whereYear('created_at', $tahun);
            })
            ->get();

        // Render view PDF, buat file blade baru khusus PDF atau reuse blade yang ada tapi minimalis
        $pdf = Pdf::loadView('admin.laporanbarang_pdf', compact('laporanbarang', 'bulan', 'tahun'));

        // Jika mau langsung download:
        return $pdf->download('laporan_barang_'.$tahun.'_'.$bulan.'.pdf');

        // Kalau mau langsung buka di browser:
        // return $pdf->stream('laporan_barang_'.$tahun.'_'.$bulan.'.pdf');
    }

    // Tampilkan detail laporan berdasarkan id
    public function show($id)
    {
        $laporanbarang = Laporan::with([
            'databarang',
            'supplier',
            'detailBarangMasuk',
            'detailBarangKeluar',
            'barangmasuk',
            'barangkeluar'
        ])->find($id);

        if (!$laporanbarang) {
            return redirect()->route('laporanbarang')->with('error', 'Laporan tidak ditemukan.');
        }

        // Kirim variabel $laporanbarang ke view, bisa juga kasih alias $laporan
        return view('admin.detaillaporanbarang', compact('laporanbarang'));
    }

    public function exportPdfDetail($id)
    {
        $laporanbarang = Laporan::with([
            'databarang',
            'supplier',
            'detailBarangMasuk',
            'detailBarangKeluar',
            'barangmasuk',
            'barangkeluar'
        ])->findOrFail($id);

        $pdf = Pdf::loadView('admin.laporanbarang_pdf_detail', compact('laporanbarang'));

        return $pdf->download('laporan_barang_detail_'.$laporanbarang->IdLaporan.'.pdf');
    }

    public function destroy($id)
    {
        $laporanbarang = Laporan::find($id);

        if (!$laporanbarang) {
            return redirect()->route('laporanbarang')->with('Gagal', 'Data tidak ditemukan.');
        }

        $laporanbarang->delete();

        return redirect()->route('laporanbarang')->with('Sukses', 'Data berhasil dihapus.');
    }

}
