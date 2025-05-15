<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;

class CartController extends Controller
{
    // Menambahkan item ke keranjang
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);

        $productId = $request->id;

        if (isset($cart[$productId])) {
            // Jika produk sudah ada, tambahkan jumlah
            $cart[$productId]['quantity']++;
        } else {
            // Jika produk belum ada, tambahkan baru
            $cart[$productId] = [
                "nama" => $request->nama,
                "harga" => $request->harga,
                "img" => $request->img,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true, 'cartCount' => count($cart)]);
    }


    // Menampilkan halaman keranjang
    public function index()
    {
        $cart = session('cart', []);
        return view('toko.cart', compact('cart'));

        
    }

    // Menghapus item dari keranjang
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }

    // Mengurangi jumlah item (quantity -1)
    public function decrease(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $id = (int) $request->input('id');

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']--;

            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
            }

            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'cartCount' => array_sum(array_column($cart, 'quantity')),
        ]);
    }
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            if ($request->type == 'increase') {
                $cart[$id]['quantity'] += 1;
            } elseif ($request->type == 'decrease' && $cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity'] -= 1;
            }
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }

}
