<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('barangs')->insert([
            [
                'program'         => 'Bantuan Logistik Korban Kebakaran Siantan',
                'prioritas'       => 'Tinggi',
                'kategori'        => 'Sembako',
                'daftar_barang'   => json_encode([
                    ['nama' => 'Beras', 'jumlah' => 50, 'satuan' => 'kg'],
                    ['nama' => 'Mie Instan', 'jumlah' => 10, 'satuan' => 'dus'],
                    ['nama' => 'Minyak Goreng', 'jumlah' => 20, 'satuan' => 'liter'],
                ]),
                'nama_pengirim'   => 'Budi Santoso',
                'hp_pengirim'     => '081234567890',
                'alamat_pengirim' => 'Jl. Veteran No.1, Pontianak',
                'ekspedisi'       => 'JNE',
                'berat'           => 80.00,
                'status'          => 'diterima',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'program'         => 'Dapur Umum Korban Banjir Kapuas Pontianak',
                'prioritas'       => 'Sedang',
                'kategori'        => 'Pakaian',
                'daftar_barang'   => json_encode([
                    ['nama' => 'Baju Dewasa', 'jumlah' => 30, 'satuan' => 'pcs'],
                    ['nama' => 'Celana Panjang', 'jumlah' => 20, 'satuan' => 'pcs'],
                    ['nama' => 'Selimut', 'jumlah' => 15, 'satuan' => 'buah'],
                ]),
                'nama_pengirim'   => 'Siti Rahma',
                'hp_pengirim'     => '089876543210',
                'alamat_pengirim' => 'Jl. Tanjungpura No.5, Pontianak',
                'ekspedisi'       => 'TIKI',
                'berat'           => 30.00,
                'status'          => 'dikirim',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'program'         => 'Darurat Banjir Bandang Landak: Air Bersih & Obat-obatan',
                'prioritas'       => 'Tinggi',
                'kategori'        => 'Obat-obatan',
                'daftar_barang'   => json_encode([
                    ['nama' => 'Masker', 'jumlah' => 100, 'satuan' => 'pcs'],
                    ['nama' => 'Obat Batuk', 'jumlah' => 50, 'satuan' => 'buah'],
                    ['nama' => 'Perban', 'jumlah' => 30, 'satuan' => 'buah'],
                ]),
                'nama_pengirim'   => 'Andi Saputra',
                'hp_pengirim'     => '082345678901',
                'alamat_pengirim' => 'Jl. Ahmad Yani No.10, Pontianak',
                'ekspedisi'       => 'SiCepat',
                'berat'           => 15.00,
                'status'          => 'pending',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'program'         => 'Patungan Sembako & Kasur Panti Asuhan Ahmad Yani',
                'prioritas'       => 'Rendah',
                'kategori'        => 'Perlengkapan',
                'daftar_barang'   => json_encode([
                    ['nama' => 'Kasur', 'jumlah' => 10, 'satuan' => 'buah'],
                    ['nama' => 'Bantal', 'jumlah' => 20, 'satuan' => 'buah'],
                    ['nama' => 'Selimut', 'jumlah' => 20, 'satuan' => 'buah'],
                ]),
                'nama_pengirim'   => 'Rina Putri',
                'hp_pengirim'     => '085678901234',
                'alamat_pengirim' => 'Jl. Gajah Mada No.3, Pontianak',
                'ekspedisi'       => 'J&T',
                'berat'           => 50.00,
                'status'          => 'diterima',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);
    }
}