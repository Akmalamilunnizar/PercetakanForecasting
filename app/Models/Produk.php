<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LaporanTransaksi;

class Produk extends Model
{
    // Nama tabel
    protected $table = 'produk';

    // Primary key bukan default 'id'
    protected $primaryKey = 'IdProduk';

    // Kalau primary key bukan auto-increment, disable incrementing
    public $incrementing = false;

    // Kalau primary key bukan integer
    protected $keyType = 'string';

    // Kolom yang bisa diisi
    protected $fillable = [
        'IdProduk',
        'NamaProduk',
        'HargaProduk',
        'Img',
    ];

    // Kalau tidak pakai timestamps (created_at, updated_at)
    public $timestamps = false;

     public function laporantransaksi()
    {
        return $this->hasMany(LaporanTransaksi::class, 'IdProduk', 'IdProduk');
    }
}
