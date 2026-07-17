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
                'id_target'       => $targets['Korban Kebakaran Siantan'],
                'judul'           => 'Bantuan Logistik Korban Kebakaran Siantan',
                'deskripsi'       => 'Program bantuan darurat untuk korban kebakaran pemukiman Siantan Hulu meliputi pakaian, tenda, dan sembako.',
                'kategori'        => 'Kebakaran',
                'target_dana'     => 20000000,
                'dana_terkumpul'  => 15200000,
                'tanggal_mulai'   => '2026-06-01',
                'tanggal_selesai' => '2026-08-01',
                'status'          => 'aktif',
                'gambar'          => 'https://images.unsplash.com/photo-1594897030264-ab7d87efc473?q=80&w=600&auto=format&fit=crop',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'id_target'       => $targets['Korban Banjir Kapuas'],
                'judul'           => 'Dapur Umum Korban Banjir Kapuas Pontianak',
                'deskripsi'       => 'Bantuan makanan siap saji, air bersih, dan pakaian untuk korban banjir luapan Sungai Kapuas.',
                'kategori'        => 'Banjir',
                'target_dana'     => 25000000,
                'dana_terkumpul'  => 18900000,
                'tanggal_mulai'   => '2026-06-10',
                'tanggal_selesai' => '2026-07-10',
                'status'          => 'aktif',
                'gambar'          => 'https://images.unsplash.com/photo-1593113598332-cd288d649433?q=80&w=600&auto=format&fit=crop',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'id_target'       => $targets['Panti Asuhan Ahmad Yani'],
                'judul'           => 'Patungan Sembako & Kasur Panti Asuhan Ahmad Yani',
                'deskripsi'       => 'Dukungan sembako bulanan dan kasur layak untuk 40 anak yatim piatu di Panti Ahmad Yani.',
                'kategori'        => 'Lainnya',
                'target_dana'     => 10000000,
                'dana_terkumpul'  => 8400000,
                'tanggal_mulai'   => '2026-05-15',
                'tanggal_selesai' => '2026-09-15',
                'status'          => 'aktif',
                'gambar'          => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=600&auto=format&fit=crop',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'id_target'       => $targets['Korban Banjir Landak'],
                'judul'           => 'Darurat Banjir Bandang Landak: Air Bersih & Obat-obatan',
                'deskripsi'       => 'Bantuan air bersih, obat-obatan, dan kebutuhan darurat untuk korban banjir bandang di Ngabang.',
                'kategori'        => 'Banjir',
                'target_dana'     => 50000000,
                'dana_terkumpul'  => 24500000,
                'tanggal_mulai'   => '2026-06-20',
                'tanggal_selesai' => '2026-08-20',
                'status'          => 'darurat',
                'gambar'          => 'https://images.unsplash.com/photo-1547683905-f686c993aae5?q=80&w=600&auto=format&fit=crop',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'id_target'       => $targets['Panti Jompo Kasih Ibu Pontianak'],
                'judul'           => 'Perawatan Lansia Panti Jompo Kasih Ibu Pontianak',
                'deskripsi'       => 'Biaya perawatan, obat-obatan rutin, dan kebutuhan sehari-hari untuk 30 lansia di Pontianak Selatan.',
                'kategori'        => 'Lainnya',
                'target_dana'     => 15000000,
                'dana_terkumpul'  => 6200000,
                'tanggal_mulai'   => '2026-06-01',
                'tanggal_selesai' => '2026-12-01',
                'status'          => 'aktif',
                'gambar'          => 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?q=80&w=600&auto=format&fit=crop',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);
    }
}