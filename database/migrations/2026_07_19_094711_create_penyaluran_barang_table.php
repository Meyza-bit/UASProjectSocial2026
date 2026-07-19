<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penyaluran_barang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_program')->nullable();
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->string('penerima')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('bukti_penyaluran')->nullable();
            $table->date('tanggal_penyaluran');
            $table->timestamps();

            $table->foreign('id_program')->references('id')->on('program_donasi')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyaluran_barang');
    }
};