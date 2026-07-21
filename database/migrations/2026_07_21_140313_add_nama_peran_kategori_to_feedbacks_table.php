<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->string('nama')->nullable()->after('user_id');
            $table->boolean('anonim')->default(false)->after('nama');
            $table->string('peran')->nullable()->after('anonim');
            $table->string('kategori')->nullable()->after('peran');
            $table->boolean('verified')->default(false)->after('kategori');
        });
    }

    public function down(): void
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->dropColumn(['nama', 'anonim', 'peran', 'kategori', 'verified']);
        });
    }
};