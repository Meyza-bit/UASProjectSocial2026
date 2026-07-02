<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramDonasiSeeder extends Seeder
{
    public function run(): void
    {
        $targets = DB::table('target_penerima')->pluck('id_target', 'nama_target');

        DB::table('program_donasi')->insert([
            [
                'id_target'       => $targets['Korban Gempa Cianjur'],
                'judul'           => 'Bantuan Darurat Gempa Cianjur',
                'deskripsi'       => 'Program bantuan darurat untuk korban gempa Cianjur meliputi sembako, pakaian, dan tenda.',
                'kategori'        => 'Gempa',
                'target_dana'     => 50000000,
                'dana_terkumpul'  => 32000000,
                'tanggal_mulai'   => '2026-06-01',
                'tanggal_selesai' => '2026-08-01',
                'status'          => 'aktif',
                'gambar'          => null,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'id_target'       => $targets['Korban Banjir Jakarta'],
                'judul'           => 'Peduli Banjir Jakarta',
                'deskripsi'       => 'Bantuan makanan, air bersih, dan pakaian untuk korban banjir Jakarta.',
                'kategori'        => 'Banjir',
                'target_dana'     => 30000000,
                'dana_terkumpul'  => 18500000,
                'tanggal_mulai'   => '2026-06-10',
                'tanggal_selesai' => '2026-07-10',
                'status'          => 'aktif',
                'gambar'          => null,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'id_target'       => $targets['Panti Asuhan Al-Ikhlas'],
                'judul'           => 'Beasiswa & Perlengkapan Belajar Panti Al-Ikhlas',
                'deskripsi'       => 'Dukungan biaya pendidikan dan perlengkapan belajar untuk 60 anak yatim piatu.',
                'kategori'        => 'Lainnya',
                'target_dana'     => 20000000,
                'dana_terkumpul'  => 8400000,
                'tanggal_mulai'   => '2026-05-15',
                'tanggal_selesai' => '2026-09-15',
                'status'          => 'aktif',
                'gambar'          => null,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'id_target'       => $targets['Korban Erupsi Merapi'],
                'judul'           => 'Tanggap Darurat Erupsi Merapi',
                'deskripsi'       => 'Bantuan masker, obat-obatan, selimut dan makanan untuk pengungsi erupsi Merapi.',
                'kategori'        => 'Erupsi',
                'target_dana'     => 40000000,
                'dana_terkumpul'  => 24500000,
                'tanggal_mulai'   => '2026-06-20',
                'tanggal_selesai' => '2026-08-20',
                'status'          => 'darurat',
                'gambar'          => null,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'id_target'       => $targets['Panti Jompo Kasih Ibu'],
                'judul'           => 'Perawatan Lansia Panti Jompo Kasih Ibu',
                'deskripsi'       => 'Biaya perawatan, obat-obatan rutin, dan kebutuhan sehari-hari untuk 45 lansia.',
                'kategori'        => 'Lainnya',
                'target_dana'     => 15000000,
                'dana_terkumpul'  => 6200000,
                'tanggal_mulai'   => '2026-06-01',
                'tanggal_selesai' => '2026-12-01',
                'status'          => 'aktif',
                'gambar'          => null,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);
    }
}