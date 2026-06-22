<?php

namespace Database\Seeders;

<<<<<<< HEAD
=======
<<<<<<< feature/halaman-barang
use App\Models\User;
use App\Models\Campaign;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
=======
>>>>>>> main
>>>>>>> 101a67dead71bdebb3a19371d7412044bf1d1afe
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
<<<<<<< HEAD
        // User dummy
=======
<<<<<<< feature/halaman-barang
        // 1. Membuat data User bawaan (tidak apa-apa dibiarkan)
>>>>>>> 101a67dead71bdebb3a19371d7412044bf1d1afe
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
=======
        // Memanggil seeder data dummy Mariberbagi
        $this->call([
            ProgramDonasiSeeder::class,
>>>>>>> main
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

        $this->call([
            FeedbackSeeder::class,
        ]);
    }
}