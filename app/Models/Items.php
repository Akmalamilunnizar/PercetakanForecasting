<?php
// app/Models/Items.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $primaryKey = 'IdBarang'; // Specify the primary key
    public $incrementing = false; // Disable auto-incrementing for string primary key
    protected $keyType = 'string'; // Specify the key type as string

    protected $table = 'databarang'; // Specify the table name

    // Relationship to TypeItems (JenisBarang)
    public function jenisBarang()
    {
        return $this->belongsTo(TypeItems::class, 'IdJenisBarang', 'IdJenisBarang');
    }

    // Relationship to Satuan
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'IdSatuan', 'IdSatuan');
    }

    // Ini harus hasOne jika Anda ingin hanya satu detail per item di tabel utama
    public function detailBarangMasuk()
    {
        return $this->hasOne(DetailMasuk::class, 'IdBarang', 'IdBarang');
        // Jika Anda ingin mengambil detail masuk terakhir, Anda bisa menambahkan orderBy
        // return $this->hasOne(DetailMasuk::class, 'IdBarang', 'IdBarang')->latestOfMany('IdMasuk');
        // atau hasOne(DetailMasuk::class, 'IdBarang', 'IdBarang')->orderByDesc('IdMasuk');
    }

    // Relationship to DetailKeluar (assuming this is the correct model name)
    public function detailBarangKeluar()
    {
        return $this->hasOne(DetailKeluar::class, 'IdBarang', 'IdBarang');
    }
    
}