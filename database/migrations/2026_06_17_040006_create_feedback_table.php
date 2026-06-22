<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_program')->nullable();
            $table->tinyInteger('rating'); // 1-5
            $table->text('isi');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_program')->references('id')->on('program_donasi')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};