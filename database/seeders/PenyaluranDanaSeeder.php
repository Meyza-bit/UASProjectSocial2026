<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenyaluranDanaSeeder extends Seeder
{
    public function run(): void
    {
        $programs = DB::table('program_donasi')->pluck('id', 'judul');

        $data = [
            [
                'program'     => 'Bantuan Logistik Korban Kebakaran Siantan',
                'jumlah'      => 300000,
                'keterangan'  => 'Penyaluran tahap 1: bantuan logistik dan kebutuhan darurat untuk korban kebakaran Siantan Hulu.',
                'tanggal'     => '2026-06-15',
            ],
            [
                'program'     => 'Dapur Umum Korban Banjir Kapuas Pontianak',
                'jumlah'      => 200000,
                'keterangan'  => 'Penyaluran dana untuk operasional dapur umum warga terdampak banjir.',
                'tanggal'     => '2026-06-20',
            ],
            [
                'program'     => 'Perawatan Lansia Panti Jompo Kasih Ibu Pontianak',
                'jumlah'      => 500000,
                'keterangan'  => 'Penyaluran dana untuk biaya perawatan dan obat-obatan rutin lansia.',
                'tanggal'     => '2026-06-25',
            ],
        ];

        foreach ($data as $d) {
            DB::table('penyaluran_dana')->insert([
                'id_program'         => $programs[$d['program']] ?? null,
                'jumlah'             => $d['jumlah'],
                'keterangan'         => $d['keterangan'],
                'bukti_penyaluran'   => null,
                'tanggal_penyaluran' => $d['tanggal'],
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);
        }
    }
}