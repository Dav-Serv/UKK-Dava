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
        Schema::create('detailpenjualans', function (Blueprint $table) {
            // if (!Schema::hasColumn('detailpenjualans', 'iddetail')) {
            //     $table->id('iddetail')->first(); // Menjadikannya sebagai primary key
            // }
            // $table->bigIncrements('iddetail');
            $table->id();
            $table->unsignedBigInteger('id_penjualan');
            $table->unsignedBigInteger('id_produk');
            $table->integer('jumlah_produk');
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();

            // Foreign Key
            $table->foreign('id_penjualan')->references('id')->on('penjualans');
            $table->foreign('id_produk')->references('id')->on('produks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailpenjualans');
    }
};
