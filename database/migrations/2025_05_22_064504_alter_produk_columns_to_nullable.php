<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->string('ukuran_produk', 100)->nullable()->change();
            $table->string('jenis_bahan_produk', 100)->nullable()->change();
            $table->string('custom_produk', 100)->nullable()->change();
            $table->integer('diskon')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            // Di sini Anda bisa menambahkan logika untuk mengembalikan kolom menjadi NOT NULL
            // jika Anda menjalankan 'php artisan migrate:rollback'
            // Contoh:
            // $table->string('ukuran_produk', 100)->nullable(false)->change();
            // $table->string('jenis_bahan_produk', 100)->nullable(false)->change();
            // $table->string('custom_produk', 100)->nullable(false)->change();
            // $table->integer('diskon')->nullable(false)->change();
        });
    }
};
