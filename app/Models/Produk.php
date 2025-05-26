<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Items;
use App\Models\Diskon;
use App\Models\Size;

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
        'ukuran',       
        'bahan',  
        'custom',       
        'diskon',
        'id_bahan',
        'Img',
        'deskripsi'
    ];

    // Kalau tidak pakai timestamps (created_at, updated_at)
    public $timestamps = false;

    // Relationships
    public function bahan()
    {
        return $this->belongsTo(Items::class, 'id_bahan', 'IdBarang');
    }

    public function diskonRelasi()
    {
        return $this->belongsTo(Diskon::class, 'diskon', 'id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'ukuran', 'id_ukuran');
    }
}
