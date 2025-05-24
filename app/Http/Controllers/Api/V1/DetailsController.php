<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;

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
            foreach ($cart as $item) {
                $total += $item['harga'] * $item['quantity'];
            }

            $transaction = new Transaksi();
            $transaction->IdTransaksi = $transactionId;
            $transaction->username = $user->username;
            $transaction->id = $user->id;
            $transaction->Bayar = $isPaid ? $total : 0;
            $transaction->SisaBayar = $isPaid ? 0 : $total;
            $transaction->Kembali = 0;
            $transaction->GrandTotal = $total;
            $transaction->tglTransaksi = now();
            $transaction->StatusPembayaran = $isPaid ? 'Lunas' : 'Belum Lunas';
            $transaction->StatusPesanan = 'Menunggu Konfirmasi';
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
