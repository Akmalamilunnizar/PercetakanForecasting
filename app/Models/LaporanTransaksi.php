<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaksi;
use App\Models\Produk;

class LaporanTransaksi extends Model
{
    use HasFactory;
    protected $table = 'laporantransaksi';
    protected $primaryKey = 'Idlaporan_transaksi';
    protected $fillable = [
        'IdTransaksi',
        'IdProduk',
    ];

     // relasi ke barang
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'IdTransaksi', 'IdTransaksi');
    }

    // relasi ke supplier
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'IdProduk', 'IdProduk');
    }
}
