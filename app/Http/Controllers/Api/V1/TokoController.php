<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\DB; //buat manggil database

class TokoController extends Controller
{
    //
    public function tokodashboard(Request $request)
    {
        $query = Produk::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('NamaProduk', 'LIKE', '%' . $request->search . '%');
        }

        $produk = $query->get();

        return view('toko.dashboardToko', compact('produk'));
    }


}
