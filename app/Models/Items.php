<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;
    protected $table = 'databarang';
    protected $primaryKey = 'IdBarang'; // ini yang penting
    protected $fillable = [
        'IdBarang', // ini buat id
        'NamaBarang',
        'IdJenisBarang',
        'JumlahStok',
        'IdSatuan'
    ];



    public $timestamps = false;  // Karena tabel jenis_koi tidak menggunakan created_at dan updated_at
    public function jenisKoi()
    {
        return $this->belongsTo(TypeItems::class, 'jenis_koi');
    }
}
