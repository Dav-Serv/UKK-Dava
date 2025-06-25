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
        Schema::create('penjualans', function (Blueprint $table) {
            // if (!Schema::hasColumn('penjualans', 'idpenjualan')) {
            //     $table->id('idpenjualan')->first(); // Menjadikannya sebagai primary key
            // }
            // $table->bigIncrements('idpenjualan');
            $table->id();
            $table->timestamp('tanggal_jual');
            $table->decimal('total_harga', 12, 2);
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedInteger('status');
            $table->timestamps();

            // Foreign Key
            $table->foreign('id_pelanggan')->references('id')->on('pelanggans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
