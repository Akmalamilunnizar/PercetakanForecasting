<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'IdTransaksi';  // <- PENTING: Ini harus sesuai nama kolom PK di DB
    // public $incrementing = false;         // Jika IdSatuan bukan auto increment
    // protected $keyType = 'string';        // Jika IdSatuan bertipe VARCHAR
    public $timestamps = false;

    protected $fillable = [
        'username',
        'id',
        'Bayar',
        'SisaBayar',
        'Kembali',
        'Grand Total',
        'tglTransaksi',
        'StatusPembayaran',
        'StatusPesanan',
        'tglUpdate',

    ];

    public function detail()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
