<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_barang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_donasi_barang');
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->string('satuan'); // kg, dus, pcs, lusin, karung, liter, buah
            $table->timestamps();

            $table->foreign('id_donasi_barang')->references('id')->on('donasi_barang')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_barang');
    }
};