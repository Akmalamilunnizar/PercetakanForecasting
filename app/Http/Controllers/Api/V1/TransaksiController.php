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
