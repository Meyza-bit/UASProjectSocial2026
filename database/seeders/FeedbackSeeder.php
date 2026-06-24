<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feedback;
use App\Models\User;

class FeedbackSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'feedback@example.com'],
            ['name' => 'User Feedback', 'password' => bcrypt('password')]
        );

        Feedback::insert([
            [
                'user_id' => $user->id,
                'program_donasi_id' => null,
                'judul' => 'Budi Santoso',
                'rating' => 5,
                'isi' => 'Program sangat transparan dan membantu korban bencana.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'program_donasi_id' => null,
                'judul' => 'Siti Rahma',
                'rating' => 4,
                'isi' => 'Penyaluran bantuan cepat dan terpercaya.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'program_donasi_id' => null,
                'judul' => 'Andi Saputra',
                'rating' => 3,
                'isi' => 'Cukup baik, semoga semakin berkembang.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'program_donasi_id' => null,
                'judul' => 'Rina Putri',
                'rating' => 5,
                'isi' => 'Saya puas dengan laporan transparansi donasi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'program_donasi_id' => null,
                'judul' => 'Dewi Lestari',
                'rating' => 4,
                'isi' => 'Sangat membantu masyarakat yang membutuhkan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
