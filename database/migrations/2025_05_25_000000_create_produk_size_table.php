<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the pivot table
        Schema::create('produk_size', function (Blueprint $table) {
            $table->string('IdProduk', 6);
            $table->integer('id_ukuran');
            $table->integer('harga'); // price for this product-size
            $table->timestamps();

            $table->foreign('IdProduk')->references('IdProduk')->on('produk')->onDelete('cascade');
            $table->foreign('id_ukuran')->references('id_ukuran')->on('size')->onDelete('cascade');
            
            $table->primary(['IdProduk', 'id_ukuran']);
        });

        // Migrate existing data
        DB::statement('
            INSERT INTO produk_size (IdProduk, id_ukuran, created_at, updated_at)
            SELECT IdProduk, ukuran, NOW(), NOW()
            FROM produk
            WHERE ukuran IS NOT NULL
        ');

        // Remove the old ukuran column
        Schema::table('produk', function (Blueprint $table) {
            if (Schema::hasColumn('produk', 'ukuran')) {
                $table->dropColumn('ukuran');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_size');
    }
}; 