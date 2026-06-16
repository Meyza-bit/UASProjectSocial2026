<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Campaign;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Membuat data User bawaan (tidak apa-apa dibiarkan)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 2. Membuat data contoh Kampanye Donasi langsung di sini
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
    }
}