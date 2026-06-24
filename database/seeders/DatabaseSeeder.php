<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Campaign;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Campaign::create([
            'title' => 'Solidaritas Sembako & Pakaian Layak Korban Banjir Bantaran Sungai',
            'target_amount' => 30000000,
            'current_amount' => 19500000,
            'category' => 'Tanggap Bencana',
            'description' => 'Kebutuhan beras, minyak goreng, dan makanan kaleng darurat untuk wilayah bantaran sungai.',
        ]);

        Campaign::create([
            'title' => 'Patungan Sediakan Paket Nutrisi Sehat & Susu Anak Yatim Panti Melati',
            'target_amount' => 25000000,
            'current_amount' => 12000000,
            'category' => 'Panti Asuhan',
            'description' => 'Paket buku tulis, tas, dan alat tulis untuk kelangsungan tahun ajaran baru adik-hari Panti Melati.',
        ]);

        $this->call([
            FeedbackSeeder::class,
        ]);
    }
}
