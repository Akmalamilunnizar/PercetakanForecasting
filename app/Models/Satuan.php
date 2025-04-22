<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    // use DefaultDatetimeFormat;
    //table name
    protected $fillable = [
        'IdSatuan',
        'Satuan',
    ];

    protected $table = 'satuan';

    public $timestamps = false;  // Karena tabel jenis_koi tidak menggunakan created_at dan updated_at
    public function jenisKoi()
    {
        return $this->belongsTo(Satuan::class, 'jenis_koi');
    }

}
