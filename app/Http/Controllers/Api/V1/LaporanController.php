<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataLaporan = Laporan::with(['barang', 'supplier'])->get();

        return view('admin.laporanbarang', compact('dataLaporan'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $laporans = [
            (object) [
                'id' => 1,
                'nama_barang' => 'Kertas A4',
                'jumlah' => 5,
                'tanggal_pengeluaran' => '2025-05-01',
                'keterangan' => 'Untuk laporan rapat'
            ],
            (object) [
                'id' => 2,
                'nama_barang' => 'Pulpen',
                'jumlah' => 10,
                'tanggal_pengeluaran' => '2025-05-03',
                'keterangan' => 'Keperluan kantor'
            ],
            (object) [
                'id' => 3,
                'nama_barang' => 'Printer Ink',
                'jumlah' => 2,
                'tanggal_pengeluaran' => '2025-05-05',
                'keterangan' => null
            ],
        ];

        // Cek apakah data ada
        if (!isset($laporans[$id])) {
            abort(404);
        }

        $laporan = $laporans[$id];

        // Return ke view dengan data laporan
        return view('admin.detaillaporanbarang', compact('laporan'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $laporan = Laporan::find($id);

        if (!$laporan) {
            return redirect()->route('alllaporan')->with('error', 'Data tidak ditemukan.');
        }

        $laporan->delete();

        return redirect()->route('alllaporan')->with('success', 'Data berhasil dihapus.');
    }
}
