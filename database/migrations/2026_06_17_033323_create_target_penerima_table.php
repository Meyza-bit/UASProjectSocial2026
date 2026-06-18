<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('target_penerima', function (Blueprint $table) {
            $table->bigIncrements('id_target');
            $table->string('nama_target');
            $table->enum('kategori_target', ['Bencana Alam', 'Panti Sosial']);
            $table->text('deskripsi_kebutuhan');
            $table->string('lokasi')->nullable();
            $table->string('provinsi')->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('target_penerima');
    }
};