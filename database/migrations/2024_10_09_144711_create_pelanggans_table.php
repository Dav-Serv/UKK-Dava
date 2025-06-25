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
        Schema::create('pelanggans', function (Blueprint $table) {
            // if (!Schema::hasColumn('pelanggans', 'idpelanggan')) {
            //     $table->id('idpelanggan')->first(); // Menjadikannya sebagai primary key
            // }
            // $table->bigIncrements('idpelanggan');
            $table->id();
            $table->string('nama_pelanggan', 255);
            $table->text('alamat');
            $table->string('telephone', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
