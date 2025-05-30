<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index() // Changed to lowercase 'index'
    {
        // Ambil data transaksi
        $transaksi = Transaksi::all();

        // Kirim data ke view
        return view("admin.allTransaksi", compact('transaksi')); // Changed 'customer' to 'transaksi'
    }


}
