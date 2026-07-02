<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();              // null kalau anonim
            $table->boolean('anonim')->default(false);
            $table->string('peran')->default('donatur');      // donatur, penerima, relawan, umum
            $table->unsignedTinyInteger('rating');             // 1 - 5
            $table->string('kategori');                        // transparansi, barang, layanan, website, lainnya
            $table->text('isi');
            $table->boolean('verified')->default(false);       // admin yang set true, misal utk donatur terdaftar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};