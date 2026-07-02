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
                'program'         => 'Bantuan Darurat Gempa Cianjur',
                'prioritas'       => 'Tinggi',
                'kategori'        => 'Sembako',
                'daftar_barang'   => json_encode([
                    ['nama' => 'Beras', 'jumlah' => 50, 'satuan' => 'kg'],
                    ['nama' => 'Mie Instan', 'jumlah' => 10, 'satuan' => 'dus'],
                    ['nama' => 'Minyak Goreng', 'jumlah' => 20, 'satuan' => 'liter'],
                ]),
                'nama_pengirim'   => 'Budi Santoso',
                'hp_pengirim'     => '081234567890',
                'alamat_pengirim' => 'Jl. Merdeka No.1, Jakarta Pusat',
                'ekspedisi'       => 'JNE',
                'berat'           => 80.00,
                'status'          => 'diterima',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'program'         => 'Peduli Banjir Jakarta',
                'prioritas'       => 'Sedang',
                'kategori'        => 'Pakaian',
                'daftar_barang'   => json_encode([
                    ['nama' => 'Baju Dewasa', 'jumlah' => 30, 'satuan' => 'pcs'],
                    ['nama' => 'Celana Panjang', 'jumlah' => 20, 'satuan' => 'pcs'],
                    ['nama' => 'Selimut', 'jumlah' => 15, 'satuan' => 'buah'],
                ]),
                'nama_pengirim'   => 'Siti Rahma',
                'hp_pengirim'     => '089876543210',
                'alamat_pengirim' => 'Jl. Sudirman No.5, Bandung',
                'ekspedisi'       => 'TIKI',
                'berat'           => 30.00,
                'status'          => 'dikirim',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'program'         => 'Tanggap Darurat Erupsi Merapi',
                'prioritas'       => 'Tinggi',
                'kategori'        => 'Obat-obatan',
                'daftar_barang'   => json_encode([
                    ['nama' => 'Masker N95', 'jumlah' => 100, 'satuan' => 'pcs'],
                    ['nama' => 'Obat Batuk', 'jumlah' => 50, 'satuan' => 'buah'],
                    ['nama' => 'Perban', 'jumlah' => 30, 'satuan' => 'buah'],
                ]),
                'nama_pengirim'   => 'Andi Saputra',
                'hp_pengirim'     => '082345678901',
                'alamat_pengirim' => 'Jl. Diponegoro No.10, Yogyakarta',
                'ekspedisi'       => 'SiCepat',
                'berat'           => 15.00,
                'status'          => 'pending',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'program'         => 'Beasiswa & Perlengkapan Belajar Panti Al-Ikhlas',
                'prioritas'       => 'Rendah',
                'kategori'        => 'Perlengkapan Belajar',
                'daftar_barang'   => json_encode([
                    ['nama' => 'Buku Tulis', 'jumlah' => 100, 'satuan' => 'buah'],
                    ['nama' => 'Pensil', 'jumlah' => 50, 'satuan' => 'buah'],
                    ['nama' => 'Tas Sekolah', 'jumlah' => 20, 'satuan' => 'buah'],
                ]),
                'nama_pengirim'   => 'Rina Putri',
                'hp_pengirim'     => '085678901234',
                'alamat_pengirim' => 'Jl. Gatot Subroto No.3, Surabaya',
                'ekspedisi'       => 'J&T',
                'berat'           => 20.00,
                'status'          => 'diterima',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);
    }
}