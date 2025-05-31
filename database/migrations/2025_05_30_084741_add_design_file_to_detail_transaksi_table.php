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
        Schema::table('detail_transaksi', function (Blueprint $table) {
            $table->string('design_file')->nullable()->after('SubTotal');
            $table->string('id_ukuran')->nullable()->after('IdProduk');
        });

        Schema::table('transaksi', function (Blueprint $table) {
            $table->unsignedBigInteger('address_id')->nullable()->after('id');
            $table->string('alamat_pengiriman')->nullable()->after('address_id');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_transaksi', function (Blueprint $table) {
            $table->dropColumn('design_file');
            $table->dropColumn('id_ukuran');
        });

        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropForeign(['address_id']);
            $table->dropColumn('address_id');
            $table->dropColumn('alamat_pengiriman');
        });
    }
};
