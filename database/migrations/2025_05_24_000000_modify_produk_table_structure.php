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
            // First check if columns exist before dropping
            if (Schema::hasColumn('produk', 'ukuran_produk')) {
                $table->dropColumn('ukuran_produk');
            }
            if (Schema::hasColumn('produk', 'jenis_bahan_produk')) {
                $table->dropColumn('jenis_bahan_produk');
            }
            if (Schema::hasColumn('produk', 'custom_produk')) {
                $table->dropColumn('custom_produk');
            }
            
            // Add new columns if they don't exist
            if (!Schema::hasColumn('produk', 'ukuran')) {
                $table->string('ukuran', 100)->nullable()->after('HargaProduk');
            }
            if (!Schema::hasColumn('produk', 'bahan')) {
                $table->string('bahan', 100)->nullable()->after('ukuran');
            }
            if (!Schema::hasColumn('produk', 'custom')) {
                $table->string('custom', 100)->nullable()->after('bahan');
            }
            
            // Handle diskon and id_bahan columns
            if (!Schema::hasColumn('produk', 'diskon')) {
                $table->integer('diskon')->nullable()->after('custom');
            }
            if (!Schema::hasColumn('produk', 'id_bahan')) {
                $table->string('id_bahan', 13)->nullable()->after('diskon');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            // Drop new columns
            $table->dropColumn(['ukuran', 'bahan', 'custom', 'diskon', 'id_bahan']);
            
            // Recreate old columns
            $table->string('ukuran_produk', 100)->nullable()->after('HargaProduk');
            $table->string('jenis_bahan_produk', 100)->nullable()->after('ukuran_produk');
            $table->string('custom_produk', 100)->nullable()->after('jenis_bahan_produk');
        });
    }
}; 