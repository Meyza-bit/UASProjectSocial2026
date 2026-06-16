<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramDonasiSeeder extends Seeder
{
    public function run(): void
    {
        // Memasukkan data dummy langsung ke tabel programs
        DB::table('programs')->insert([
            [
                'kategori' => 'Tanggap Bencana',
                'judul' => 'Solidaritas Sembako & Pakaian Layak Korban Banjir Bantaran Sungai',
                'img' => 'https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=600&auto=format&fit=crop',
                'persen' => '65%',
                'terkumpul' => 'Rp 19.500.000',
                'target' => 'Rp 30.000.000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori' => 'Panti Asuhan',
                'judul' => 'Patungan Sediakan Paket Nutrisi Sehat & Susu Anak Yatim Panti Melati',
                'img' => 'https://images.unsplash.com/photo-1509099836639-18ba1795216d?q=80&w=600&auto=format&fit=crop',
                'persen' => '48%',
                'terkumpul' => 'Rp 12.000.000',
                'target' => 'Rp 25.000.000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori' => 'Panti Jompo',
                'judul' => 'Bantu Kenyamanan Lansia: Pengadaan Kasur Medis & Popok Panti Jompo Harapan',
                'img' => 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?q=80&w=600&auto=format&fit=crop',
                'persen' => '20%',
                'terkumpul' => 'Rp 4.000.000',
                'target' => 'Rp 20.000.000',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}