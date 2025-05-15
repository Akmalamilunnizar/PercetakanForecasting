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
    public function index()
    {
        $laporanbarang = Laporan::with(['databarang', 'supplier', 'detailBarangMasuk', 'detailBarangKeluar', 'barangmasuk', 'barangkeluar'])->get();
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
        ]);
        // $dataLaporan = Laporan::with(['databarang', 'supplier', 'detailBarangMasuk', 'detailBarangKeluar'])->get();

        // return view('admin.laporanbarang', compact('dataLaporan'));
    }

    public function destroy($id)
    {
        $laporan = Laporan::find($id);

        if (!$laporan) {
            return redirect()->route('laporanbarang.index')->with('Gagal', 'Data tidak ditemukan.');
        }

        $laporan->delete();

        return redirect()->route('laporanbarang.index')->with('Sukses', 'Data berhasil dihapus.');
    }
}
