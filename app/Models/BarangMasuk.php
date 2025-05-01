<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table = 'barangmasuk';
    protected $primaryKey = 'IdMasuk';
    protected $fillable = [
        'IdMasuk',
        'username', // ini buat id
        'tglMasuk',
    ];

    public $timestamps = false;

}
