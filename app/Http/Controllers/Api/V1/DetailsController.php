<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function cart()
    {
        Session::put('order_step', 1);
        return view('order.cart');
    }

    public function persiapan()
    {
        Session::put('order_step', 2);
        return view('order.persiapan');
    }

    public function cetak()
    {
        Session::put('order_step', 3);
        return view('order.cetak');
    }

    public function kirim()
    {
        Session::put('order_step', 4);
        return view('order.kirim');
    }
}
