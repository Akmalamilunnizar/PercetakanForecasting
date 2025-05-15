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
            $table->bigIncrements('IdLaporan');
            $table->string('IdBarang', 13);
            $table->unsignedBigInteger('IdSupplier')->nullable();
            $table->integer('QtyMasuk')->default(0);
            $table->integer('QtyKeluar')->default(0);
            $table->timestamps();

            // Menambahkan foreign key
            $table->foreign('IdBarang')->references('IdBarang')->on('databarang')->onDelete('cascade');
            $table->foreign('IdSupplier')->references('IdSupplier')->on('supplier')->onDelete('set null');
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
