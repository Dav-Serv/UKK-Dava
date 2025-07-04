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
        Schema::create('produks', function (Blueprint $table) {
            // if (!Schema::hasColumn('produks', 'idproduk')) {
            //     $table->id('idproduk')->first(); // Menjadikannya sebagai primary key
            // }
            // $table->bigIncrements('idproduk');
            $table->id();
            $table->string('nama_produk', 255);
            $table->decimal('harga', 12, 2);
            $table->integer('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
