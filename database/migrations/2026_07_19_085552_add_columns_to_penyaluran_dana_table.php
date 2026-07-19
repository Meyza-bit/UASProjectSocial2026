<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penyaluran_dana', function (Blueprint $table) {
            if (! Schema::hasColumn('penyaluran_dana', 'id_program')) {
                $table->unsignedBigInteger('id_program')->nullable()->after('id');
            }
            if (! Schema::hasColumn('penyaluran_dana', 'jumlah')) {
                $table->bigInteger('jumlah')->default(0);
            }
            if (! Schema::hasColumn('penyaluran_dana', 'keterangan')) {
                $table->text('keterangan')->nullable();
            }
            if (! Schema::hasColumn('penyaluran_dana', 'bukti_penyaluran')) {
                $table->string('bukti_penyaluran')->nullable();
            }
            if (! Schema::hasColumn('penyaluran_dana', 'tanggal_penyaluran')) {
                $table->date('tanggal_penyaluran')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('penyaluran_dana', function (Blueprint $table) {
            $table->dropColumn(['id_program', 'jumlah', 'keterangan', 'bukti_penyaluran', 'tanggal_penyaluran']);
        });
    }
};