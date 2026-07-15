<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbackSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('feedbacks')->insert([
            [
                'nama'       => 'Budi Santoso',
                'anonim'     => false,
                'peran'      => 'donatur',
                'rating'     => 5,
                'kategori'   => 'transparansi',
                'isi'        => 'Program sangat transparan dan membantu korban bencana.',
                'verified'   => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama'       => 'Siti Rahma',
                'anonim'     => false,
                'peran'      => 'donatur',
                'rating'     => 4,
                'kategori'   => 'layanan',
                'isi'        => 'Penyaluran bantuan cepat dan terpercaya.',
                'verified'   => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama'       => 'Andi Saputra',
                'anonim'     => false,
                'peran'      => 'donatur',
                'rating'     => 3,
                'kategori'   => 'website',
                'isi'        => 'Cukup baik, semoga semakin berkembang.',
                'verified'   => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama'       => 'Rina Putri',
                'anonim'     => false,
                'peran'      => 'donatur',
                'rating'     => 5,
                'kategori'   => 'transparansi',
                'isi'        => 'Saya puas dengan laporan transparansi donasi.',
                'verified'   => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama'       => 'Dewi Lestari',
                'anonim'     => false,
                'peran'      => 'relawan',
                'rating'     => 4,
                'kategori'   => 'barang',
                'isi'        => 'Sangat membantu masyarakat yang membutuhkan.',
                'verified'   => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}