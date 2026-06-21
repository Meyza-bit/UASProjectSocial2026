<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('donasis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('amount', 15, 2);
            $table->text('message')->nullable(); // KOLOM BARU: pesan/doa dari donatur
            $table->string('metode_pembayaran')->nullable();
            $table->string('status')->default('pending'); // pending, lunas, gagal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasis');
    }
};