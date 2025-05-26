<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $table = 'size';
    protected $primaryKey = 'id_ukuran';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'panjang',
        'lebar',
        'id_satuan'
    ];

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'id_satuan', 'IdSatuan');
    }

    public function produk()
    {
        return $this->hasMany(Produk::class, 'ukuran', 'id_ukuran');
    }
} 