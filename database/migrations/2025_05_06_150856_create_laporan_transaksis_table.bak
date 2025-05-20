<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanTransaksisTable extends Migration
{
    public function up()
    {
        Schema::create('laporan_transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->string('nama_pelanggan');
            $table->string('produk');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 12, 2);
            $table->decimal('total_harga', 12, 2);
            $table->date('tanggal_transaksi');
            $table->string('status_pembayaran')->default('Belum Lunas'); // Lunas / Belum Lunas
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan_transaksis');
    }
}
