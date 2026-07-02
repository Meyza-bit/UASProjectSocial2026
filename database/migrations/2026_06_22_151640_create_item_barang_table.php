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
            $table->foreignId('donasi_barang_id')->constrained('donasi_barangs')->onDelete('cascade');
            $table->string('nama_barang');
            $table->string('kategori')->nullable();
            $table->integer('jumlah');
            $table->string('satuan')->default('pcs'); // pcs, kg, lusin, dll
            $table->enum('kondisi', ['baru', 'layak_pakai', 'rusak'])->default('layak_pakai');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_barang');
    }
};