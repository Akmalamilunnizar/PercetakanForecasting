<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('laporanbarang', function (Blueprint $table) {
            $table->id('IdLaporan');
            $table->foreignId('IdBarang')->constrained('databarang')->onDelete('cascade'); 
            $table->foreignId('IdSupplier')->constrained('supplier')->onDelete('cascade');
            $table->foreignId('IdMasuk')->constrained('detail_barangmasuk')->onDelete('cascade');
            $table->foreignId('IdKeluar')->constrained('detail_barangkeluar')->onDelete('cascade');
            $table->foreignId('IdIn')->constrained('barangmasuk')->onDelete('cascade');
            $table->foreignId('IdOut')->constrained('barangkeluar')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporanbarang');
    }
};
