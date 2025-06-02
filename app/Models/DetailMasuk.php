<?php
// app/Models/DetailMasuk.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMasuk extends Model
{
    use HasFactory;

    protected $table = 'detail_barangmasuk'; // Specify the table name
    protected $primaryKey = null; // No primary key for pivot table
    public $incrementing = false; // Disable auto-incrementing
    protected $guarded = []; // Allow mass assignment for all fields

    // Relationship to BarangMasuk
    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'IdMasuk', 'IdMasuk');
    }

    // Relationship to Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'IdSupplier', 'IdSupplier');
    }

    // Relationship to Items (Barang)
    public function item()
    {
        return $this->belongsTo(Items::class, 'IdBarang', 'IdBarang');
    }
}