<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

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

    public function confirmOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            // ... existing code ...

            // Determine payment status
            $isPaid = session('midtrans_paid', false);
            $total = 0;
            foreach ($cart as $id => $details) {
                $parts = explode('|', $id);
                $productId = $parts[0];
                $sizeId = $parts[1] ?? null;

                $detailData = [
                    'IdTransaksi' => $transactionId,
                    'IdProduk' => $details['id'],
                    'QtyProduk' => $details['quantity'],
                    'SubTotal' => $details['harga'] * $details['quantity'],
                    'design_file' => $details['design_file'] ?? null,
                ];
                if ($sizeId !== null) {
                    $detailData['id_ukuran'] = $sizeId;
                }

                $detail = DetailTransaksi::create($detailData);
                $total += $details['harga'] * $details['quantity'];
            }

            $selectedAddressId = session('selected_address_id');
            $address = \App\Models\Address::find($selectedAddressId);

            $transaction = new Transaksi();
            $transaction->IdTransaksi = $transactionId;
            $transaction->username = $user->username;
            $transaction->id = $user->id;
            $transaction->Bayar = $isPaid ? $total : 0;
            $transaction->GrandTotal = $total;
            $transaction->tglTransaksi = now();
            $transaction->StatusPembayaran = $isPaid ? 'Lunas' : 'Belum Lunas';
            $transaction->StatusPesanan = 'Menunggu Konfirmasi';
            if ($address) {
                $transaction->address_id = $address->id;
                $transaction->alamat_pengiriman = $address->full_address;
            }
            $transaction->save();

            // ... existing code ...

            // Clear payment flag after order
            session()->forget('midtrans_paid');

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dikonfirmasi!',
                'transaction_id' => $transactionId,
                'redirect' => route('tokodashboard')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            // ... error handling ...
        }
    }
}
