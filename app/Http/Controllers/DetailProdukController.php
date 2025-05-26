<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DetailProdukController extends Controller
{
    public function show($id)
    {
        // Get product details
        $produk = DB::table('produk')
            ->where('IdProduk', $id)
            ->first();

        if (!$produk) {
            return redirect()->route('home')->with('error', 'Produk tidak ditemukan');
        }

        // Calculate price after discount
        $hargaSetelahDiskon = $produk->HargaProduk;
        if ($produk->diskon) {
            $hargaSetelahDiskon = $produk->HargaProduk - ($produk->HargaProduk * $produk->diskon / 100);
        }

        // Get user's phone number if logged in
        $userPhone = null;
        if (Auth::check()) {
            $userPhone = Auth::user()->no_telp;
        }

        return view('toko.detail-produk', compact('produk', 'hargaSetelahDiskon', 'userPhone'));
    }

    public function addToCart(Request $request)
    {
        try {
            $productId = $request->input('product_id');
            $quantity = $request->input('quantity', 1);
            $printOption = $request->input('print_option');
            $notes = $request->input('notes');
            $designFile = $request->file('design_file');

            // Validate product exists
            $product = DB::table('produk')
                ->where('IdProduk', $productId)
                ->first();

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak ditemukan'
                ], 404);
            }

            // Handle file upload if exists
            $designFilePath = null;
            if ($designFile) {
                $designFilePath = $designFile->store('designs', 'public');
            }

            // Add to cart session
            $cart = session()->get('cart', []);
            
            $cart[$productId] = [
                'id' => $productId,
                'nama' => $product->NamaProduk,
                'harga' => $product->HargaProduk,
                'quantity' => $quantity,
                'img' => $product->Img,
                'print_option' => $printOption,
                'notes' => $notes,
                'design_file' => $designFilePath,
                'file_name' => $designFile ? $designFile->getClientOriginalName() : null
            ];

            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan ke keranjang'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
} 