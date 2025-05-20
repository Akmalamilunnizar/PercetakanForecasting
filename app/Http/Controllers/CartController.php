<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function saveAddress(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'phone' => 'required|string',
        ]);

        session([
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'phone' => $request->phone,
        ]);

        return response()->json(['success' => true]);
    }

    public function saveShipping(Request $request)
    {
        $request->validate([
            'method' => 'required|in:kurir,pickup',
            'cost' => 'required|numeric|min:0',
        ]);

        session([
            'shipping_method' => $request->method,
            'shipping_cost' => $request->cost,
        ]);

        return response()->json(['success' => true]);
    }

    public function confirmOrder(Request $request)
    {
        // ... existing code ...
    }
} 