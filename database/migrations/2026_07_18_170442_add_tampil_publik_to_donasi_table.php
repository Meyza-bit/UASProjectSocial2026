<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donasi_dana', function (Blueprint $table) {
            $table->boolean('tampil_publik')->default(true)->after('status');
        });

        Schema::table('donasi_barangs', function (Blueprint $table) {
            $table->boolean('tampil_publik')->default(true)->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('donasi_dana', function (Blueprint $table) {
            $table->dropColumn('tampil_publik');
        });

        Schema::table('donasi_barangs', function (Blueprint $table) {
            $table->dropColumn('tampil_publik');
        });
    }
};