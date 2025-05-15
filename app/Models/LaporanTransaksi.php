<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanTransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'nama_pelanggan',
        'produk',
        'jumlah',
        'harga_satuan',
        'total_harga',
        'tanggal_transaksi',
        'status_pembayaran',
        'keterangan',
    ];
}
