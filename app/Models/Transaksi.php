<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'IdTransaksi';  // <- PENTING: Ini harus sesuai nama kolom PK di DB
    public $incrementing = false;
    // protected $keyType = 'string';        // Jika IdSatuan bertipe VARCHAR
    public $timestamps = false;

    protected $fillable = [
        'IdTransaksi',
        'username',
        'id',
        'Bayar',
        'SisaBayar',
        'Kembali',
        'GrandTotal',
        'tglTransaksi',
        'StatusPembayaran',
        'StatusPesanan',
        'tglUpdate'
    ];

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'IdTransaksi', 'IdTransaksi');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'IdCust', 'IdCust');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
    public function detail()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
