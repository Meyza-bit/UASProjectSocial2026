<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbackSeeder extends Seeder
{
    public function run(): void
    {
        $userId = DB::table('users')->first()->id;
        $programs = DB::table('program_donasi')->pluck('id', 'judul');

        $data = [
            [
                'program' => 'Bantuan Logistik Korban Kebakaran Siantan',
                'judul'   => 'Program sangat transparan',
                'isi'     => 'Program sangat transparan dan membantu korban bencana.',
                'rating'  => 5,
            ],
            [
                'program' => 'Dapur Umum Korban Banjir Kapuas Pontianak',
                'judul'   => 'Penyaluran cepat',
                'isi'     => 'Penyaluran bantuan cepat dan terpercaya.',
                'rating'  => 4,
            ],
            [
                'program' => 'Patungan Sembako & Kasur Panti Asuhan Ahmad Yani',
                'judul'   => 'Cukup baik',
                'isi'     => 'Cukup baik, semoga semakin berkembang.',
                'rating'  => 3,
            ],
            [
                'program' => 'Darurat Banjir Bandang Landak: Air Bersih & Obat-obatan',
                'judul'   => 'Puas dengan laporan',
                'isi'     => 'Saya puas dengan laporan transparansi donasi.',
                'rating'  => 5,
            ],
            [
                'program' => 'Perawatan Lansia Panti Jompo Kasih Ibu Pontianak',
                'judul'   => 'Sangat membantu',
                'isi'     => 'Sangat membantu masyarakat yang membutuhkan.',
                'rating'  => 4,
            ],
        ];

        foreach ($data as $d) {
            DB::table('feedbacks')->insert([
                'user_id'           => $userId,
                'program_donasi_id' => $programs[$d['program']] ?? null,
                'judul'             => $d['judul'],
                'isi'               => $d['isi'],
                'rating'            => $d['rating'],
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}