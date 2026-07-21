<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonasiBarangSeeder extends Seeder
{
    public function run(): void
    {
        $userId = DB::table('users')->first()->id;
        $programs = DB::table('program_donasi')->pluck('id', 'judul');

        $data = [
            [
                'program'  => 'Bantuan Logistik Korban Kebakaran Siantan',
                'nama'     => 'Reza Firmansyah',
                'alamat'   => 'Jl. Ahmad Yani, Pontianak',
                'telepon'  => '081234567001',
                'catatan'  => 'Semoga bermanfaat untuk warga terdampak.',
                'items'    => [
                    ['nama_barang' => 'Selimut', 'kategori' => 'Perlengkapan', 'jumlah' => 20, 'satuan' => 'pcs', 'kondisi' => 'baru'],
                    ['nama_barang' => 'Air Mineral', 'kategori' => 'Konsumsi', 'jumlah' => 5, 'satuan' => 'dus', 'kondisi' => 'baru'],
                ],
            ],
            [
                'program'  => 'Dapur Umum Korban Banjir Kapuas Pontianak',
                'nama'     => 'Salsabila Ramadhani',
                'alamat'   => 'Jl. Tanjungpura, Pontianak',
                'telepon'  => '081234567002',
                'catatan'  => 'Semoga cepat pulih ya.',
                'items'    => [
                    ['nama_barang' => 'Beras', 'kategori' => 'Sembako', 'jumlah' => 50, 'satuan' => 'kg', 'kondisi' => 'baru'],
                    ['nama_barang' => 'Mie Instan', 'kategori' => 'Sembako', 'jumlah' => 10, 'satuan' => 'dus', 'kondisi' => 'baru'],
                ],
            ],
            [
                'program'  => 'Darurat Banjir Bandang Landak: Air Bersih & Obat-obatan',
                'nama'     => 'Komunitas Peduli Kalbar',
                'alamat'   => 'Jl. Gajah Mada, Singkawang',
                'telepon'  => '081234567003',
                'catatan'  => 'Dari kami untuk warga Landak, semangat!',
                'items'    => [
                    ['nama_barang' => 'Masker', 'kategori' => 'Kesehatan', 'jumlah' => 500, 'satuan' => 'pcs', 'kondisi' => 'baru'],
                    ['nama_barang' => 'Obat-obatan', 'kategori' => 'Kesehatan', 'jumlah' => 15, 'satuan' => 'pcs', 'kondisi' => 'baru'],
                ],
            ],
        ];

        foreach ($data as $d) {
            $donasiBarangId = DB::table('donasi_barangs')->insertGetId([
                'program_donasi_id' => $programs[$d['program']] ?? null,
                'user_id'           => $userId,
                'nama_pengirim'     => $d['nama'],
                'alamat_pengirim'   => $d['alamat'],
                'nomor_telepon'     => $d['telepon'],
                'status'            => 'diterima',
                'tampil_publik'     => 1,
                'catatan'           => $d['catatan'],
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);

            foreach ($d['items'] as $item) {
                DB::table('item_barang')->insert([
                    'donasi_barang_id' => $donasiBarangId,
                    'nama_barang'      => $item['nama_barang'],
                    'kategori'         => $item['kategori'],
                    'jumlah'           => $item['jumlah'],
                    'satuan'           => $item['satuan'],
                    'kondisi'          => $item['kondisi'],
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ]);
            }
        }
    }
}