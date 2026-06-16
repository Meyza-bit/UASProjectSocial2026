<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donasi_barang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->unsignedBigInteger('id_target')->nullable();
            $table->string('kategori');
            $table->string('nama_pengirim');
            $table->string('hp_pengirim');
            $table->text('alamat_pengirim');
            $table->string('kota_pengirim')->nullable();
            $table->string('provinsi_pengirim')->nullable();
            $table->string('kodepos_pengirim')->nullable();
            $table->string('ekspedisi');
            $table->decimal('berat_total', 8, 2)->nullable();
            $table->text('catatan')->nullable();
            $table->enum('status', ['pending', 'dikirim', 'diterima'])->default('pending');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_target')->references('id_target')->on('target_penerima')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donasi_barang');
    }
};