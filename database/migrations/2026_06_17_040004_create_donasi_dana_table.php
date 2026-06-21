<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donasi_dana', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->unsignedBigInteger('id_program')->nullable();
            $table->unsignedBigInteger('id_target')->nullable();
            $table->bigInteger('nominal');
            $table->enum('metode_bayar', ['transfer_bca', 'transfer_mandiri', 'gopay', 'ovo', 'dana', 'qris']);
            $table->text('pesan')->nullable();
            $table->boolean('anonim')->default(false);
            $table->enum('status', ['pending', 'verified', 'ditolak'])->default('pending');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_program')->references('id')->on('program_donasi')->onDelete('set null');
            $table->foreign('id_target')->references('id_target')->on('target_penerima')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donasi_dana');
    }
};