<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgToProdukTable extends Migration
{
    /**
     * Menjalankan migrasi untuk menambah kolom img.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->string('Img')->nullable(); // Menambahkan kolom img
        });
    }

    /**
     * Membalikkan migrasi untuk menghapus kolom img.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn('Img'); // Menghapus kolom img
        });
    }
}
