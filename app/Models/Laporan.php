<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    protected $table = 'laporanbarang';
    protected $primaryKey = 'IdLaporan';
    public $timestamps = false;
    protected $fillable = [
        'IdBarang',
        'IdSupplier',
        'QtyMasuk',
        'QtyKeluar',
    ];

    // relasi ke barang
    public function barang()
    {
        return $this->belongsTo(Items::class, 'IdBarang', 'IdBarang');
    }

    // relasi ke supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'IdSupplier', 'IdSupplier');
    }

    // relasi ke detail barang masuk
    public function detaiBaranglMasuk()
    {
        return $this->hasOne(DetailMasuk::class, 'IdBarang', 'IdBarang');
    }

    // relasi ke detail barang keluar
    public function detailBarangKeluar()
    {
        return $this->hasOne(DetailKeluar::class, 'IdBarang', 'IdBarang');
    }

    // accessor: sisa stok
    public function getSisaStokAttribute()
    {
        return ($this->QtyMasuk ?? 0) - ($this->QtyKeluar ?? 0);
    }
}
