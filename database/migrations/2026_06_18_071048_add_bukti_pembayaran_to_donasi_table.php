<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('donasi', function (Blueprint $table) {
            // Menyimpan path file bukti transfer yang diupload donatur
            $table->string('bukti_pembayaran')->nullable()->after('metode_pembayaran');
        });
    }

    public function down(): void
    {
        Schema::table('donasi', function (Blueprint $table) {
            $table->dropColumn('bukti_pembayaran');
        });
    }
};