<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Laporan;

class DetailMasuk extends Model
{
    use HasFactory;
    protected $table = 'detail_barangmasuk';
    protected $fillable = [
        'IdBarang',
        'IdMasuk',
        'IdSupplier', // ini buat id
        'QtyMasuk',
        'HargaSatuan',
        'SubTotal'
    ];

    public $timestamps = false;

    // relasi ke laporan
    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'IdMasuk', 'IdMasuk');
    }

}
