<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function confirmOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            // Check if user is authenticated
            if (!Auth::check()) {
                Log::warning('User not authenticated');
                return response()->json([
                    'error' => 'Silakan login terlebih dahulu!'
                ], 401);
            }

            // Get authenticated user
            $user = Auth::user();
            if (!$user) {
                Log::error('User object is null after Auth::check()');
                return response()->json([
                    'error' => 'Terjadi kesalahan autentikasi'
                ], 401);
            }

            // Add debugging
            Log::info('Confirm Order Request Received', [
                'user' => $user->username,
                'request' => $request->all()
            ]);
            
            // Get cart data from session
            $cart = session('cart');
            Log::info('Cart data:', ['cart' => $cart]);
            
            if (!$cart || empty($cart)) {
                Log::warning('Cart is empty');
                return response()->json([
                    'error' => 'Keranjang kosong!'
                ], 400);
            }

            // Get or create customer
            $customerId = 'C' . str_pad(Customer::count() + 1, 4, '0', STR_PAD_LEFT);
            $customer = Customer::firstOrCreate(
                ['id' => $user->id],
                [
                    'NamaCust' => $user->f_name,
                    'NoTelp' => $user->nomor_telepon ?? '',
                    'Email' => $user->email,
                    'Alamat' => $user->alamat ?? ''
                ]
            );
            Log::info('Customer data:', ['customer' => $customer->toArray()]);

            // Generate transaction ID
            $transactionId = 'TR' . str_pad(Transaksi::count() + 1, 4, '0', STR_PAD_LEFT);
            Log::info('Generated transaction ID:', ['id' => $transactionId]);

            // Get payment method and calculate total
            $isPaid = session('midtrans_paid', false);
            $paymentMethod = session('payment_method', 'cod'); // default to cod
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['harga'] * $item['quantity'];
            }
            Log::info('Calculated total:', ['total' => $total]);

            // Create transaction
            $transaction = new Transaksi();
            $transaction->IdTransaksi = $transactionId;
            $transaction->username = $user->username;
            $transaction->id = $user->id;

            if ($paymentMethod === 'midtrans' && $isPaid) {
                $transaction->Bayar = $total;
                $transaction->SisaBayar = 0;
                $transaction->StatusPembayaran = 'Lunas';
            } else {
                $transaction->Bayar = 0;
                $transaction->SisaBayar = $total;
                $transaction->StatusPembayaran = 'Belum Lunas';
            }

            $transaction->Kembali = 0;
            $transaction->GrandTotal = $total;
            $transaction->tglTransaksi = now();
            $transaction->StatusPesanan = 'Menunggu Konfirmasi';
            $transaction->save();
            
            Log::info('Transaction created:', ['transaction' => $transaction->toArray()]);

            // Create transaction details
            foreach ($cart as $id => $details) {
                $detail = DetailTransaksi::create([
                    'IdTransaksi' => $transactionId,
                    'IdProduk' => $id,
                    'QtyProduk' => $details['quantity'],
                    'SubTotal' => $details['harga'] * $details['quantity']
                ]);
                Log::info('Transaction detail created:', ['detail' => $detail->toArray()]);

                // Create laporan_transaksis record
                \App\Models\LaporanTransaksi::create([
                    'kode_transaksi' => $transactionId,
                    'nama_pelanggan' => $user->f_name,
                    'produk' => $details['nama'],
                    'jumlah' => $details['quantity'],
                    'harga_satuan' => $details['harga'],
                    'total_harga' => $details['harga'] * $details['quantity'],
                    'tanggal_transaksi' => now()->toDateString(),
                    'status_pembayaran' => $transaction->StatusPembayaran,
                    'keterangan' => 'Pesanan baru'
                ]);
            }

            // Clear cart and payment flags
            session()->forget('cart');
            session()->forget('midtrans_paid');
            session()->forget('payment_method');
            Log::info('Cart cleared from session');

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dikonfirmasi!',
                'transaction_id' => $transactionId,
                'redirect' => route('tokodashboard')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in confirmOrder: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'user' => Auth::user() ? Auth::user()->username : 'not authenticated',
                'request' => $request->all()
            ]);
            return response()->json([
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
} 