<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_donasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_target');
            $table->string('judul');
            $table->text('deskripsi');
            $table->enum('kategori', ['Banjir', 'Gempa', 'Erupsi', 'Kebakaran', 'Lainnya']);
            $table->bigInteger('target_dana');
            $table->bigInteger('dana_terkumpul')->default(0);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', ['aktif', 'selesai', 'darurat'])->default('aktif');
            $table->string('gambar')->nullable();
            $table->timestamps();

            $table->foreign('id_target')->references('id_target')->on('target_penerima')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_donasi');
    }
};