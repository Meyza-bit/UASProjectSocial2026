<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feedback;

class FeedbackSeeder extends Seeder
{
    public function run(): void
    {
        Feedback::insert([
            ['nama' => 'Budi Santoso', 'rating' => 5, 'ulasan' => 'Program sangat transparan dan membantu korban bencana.', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Siti Rahma', 'rating' => 4, 'ulasan' => 'Penyaluran bantuan cepat dan terpercaya.', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Andi Saputra', 'rating' => 3, 'ulasan' => 'Cukup baik, semoga semakin berkembang.', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Rina Putri', 'rating' => 5, 'ulasan' => 'Saya puas dengan laporan transparansi donasi.', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Dewi Lestari', 'rating' => 4, 'ulasan' => 'Sangat membantu masyarakat yang membutuhkan.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}