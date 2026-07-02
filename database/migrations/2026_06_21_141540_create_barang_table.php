<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();

            // Tujuan pengiriman
            $table->string('program');
            $table->string('prioritas');
            $table->string('kategori');

            // Daftar barang dinamis (nama, jumlah, satuan) disimpan sebagai JSON
            // karena jumlahnya bisa berbeda-beda tiap pengiriman (lewat tombol "+ Tambah Barang")
            $table->json('daftar_barang');

            // Data pengirim
            $table->string('nama_pengirim');
            $table->string('hp_pengirim');
            $table->text('alamat_pengirim');

            // Metode pengiriman
            $table->string('ekspedisi');
            $table->decimal('berat', 8, 2)->nullable();

            // Status verifikasi oleh tim logistik
            $table->string('status')->default('pending'); // pending, diproses, diterima

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};