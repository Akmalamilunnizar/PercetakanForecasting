<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKeluar extends Model
{
    use HasFactory;
    protected $table = 'detail_barangkeluar';
    protected $fillable = [
        'IdBarang', // ini buat id
        'IdKeluar',
        'QtyKeluar'
    ];

    public $timestamps = false;  // Karena tabel jenis_koi tidak menggunakan created_at dan updated_at
}
