<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Items;
use App\Models\Supplier;
use App\Models\DetailMasuk;
use App\Models\DetailKeluar;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

class Laporan extends Model
{
    use HasFactory;
    protected $table = 'laporanbarang';
    protected $primaryKey = 'IdLaporan';
    protected $fillable = [
        'IdBarang',
        'IdSupplier',
        'IdMasuk',
        'IdKeluar',
        'IdIn',
        'IdOut',
    ];

    // relasi ke barang
    public function databarang()
    {
        return $this->belongsTo(Items::class, 'IdBarang', 'IdBarang');
    }

    // relasi ke supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'IdSupplier', 'IdSupplier');
    }

    // relasi ke detail barang masuk
    public function detailBarangMasuk()
    {
        return $this->belongsTo(DetailMasuk::class, 'IdMasuk', 'IdMasuk');
    }

    // relasi ke detail barang keluar
    public function detailBarangKeluar()
    {
        return $this->belongsTo(DetailKeluar::class, 'IdKeluar', 'IdKeluar');
    }

    // relasi ke barang masuk
    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'IdIn', 'idmasuk');
    }

    // relasi ke barang keluar
    public function barangKeluar()
    {
        return $this->belongsTo(BarangKeluar::class, 'IdOut', 'idkeluar');
    }

}
