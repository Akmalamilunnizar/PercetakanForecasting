<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeItems extends Model
{
    // use DefaultDatetimeFormat;
    //table name
    protected $fillable = [
        'IdJenisBarang',
        'JenisBarang',
    ];

    protected $table = 'jenisbarang';

    public $timestamps = false;  // Karena tabel jenis_koi tidak menggunakan created_at dan updated_at
    public function jenisKoi()
    {
        return $this->belongsTo(TypeItems::class, 'jenis_koi');
    }

}
