<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeliveryShoppingController extends Controller
{
    public function index()
    {
        $cartItems = [/* ... */];
        $shippingOptions = [/* ... */];
        return view('admin.deliveryshopping', compact('cartItems', 'shippingOptions'));
    }
}
