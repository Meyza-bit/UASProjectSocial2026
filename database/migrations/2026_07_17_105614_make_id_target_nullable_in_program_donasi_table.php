<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('program_donasi', function (Blueprint $table) {
            $table->dropForeign(['id_target']);
        });

        Schema::table('program_donasi', function (Blueprint $table) {
            $table->unsignedBigInteger('id_target')->nullable()->change();
        });

        Schema::table('program_donasi', function (Blueprint $table) {
            $table->foreign('id_target')->references('id_target')->on('target_penerima')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('program_donasi', function (Blueprint $table) {
            $table->dropForeign(['id_target']);
        });

        Schema::table('program_donasi', function (Blueprint $table) {
            $table->unsignedBigInteger('id_target')->nullable(false)->change();
        });

        Schema::table('program_donasi', function (Blueprint $table) {
            $table->foreign('id_target')->references('id_target')->on('target_penerima')->onDelete('cascade');
        });
    }
};