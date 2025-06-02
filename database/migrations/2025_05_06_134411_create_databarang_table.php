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
        Schema::create('databarang', function (Blueprint $table) {
            $table->string('IdBarang', 13)->primary();
            $table->string('NamaBarang', 25)->nullable();
            $table->string('IdJenisBarang', 6)->nullable();
            $table->integer('JumlahStok')->default(0);
            $table->string('IdSatuan', 6)->nullable();
            $table->foreign('IdJenisBarang')->references('IdJenisBarang')->on('jenisbarang');
            $table->foreign('IdSatuan')->references('IdSatuan')->on('satuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('databarang');
    }
}; 