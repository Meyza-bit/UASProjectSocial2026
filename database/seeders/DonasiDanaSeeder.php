<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonasiDanaSeeder extends Seeder
{
    public function run(): void
    {
        $userId = DB::table('users')->where('email', 'ocel@gmail.com')->value('id');
        $programs = DB::table('program_donasi')->pluck('id', 'judul');
        $targets = DB::table('program_donasi')->pluck('id_target', 'judul');

        $data = [
            ['program' => 'Bantuan Logistik Korban Kebakaran Siantan', 'nominal' => 500000, 'metode' => 'transfer_bca', 'pesan' => 'Semoga cepat pulih ya, tetap semangat.', 'status' => 'verified', 'nama' => 'Kevin Anugrah'],
            ['program' => 'Dapur Umum Korban Banjir Kapuas Pontianak', 'nominal' => 250000, 'metode' => 'gopay', 'pesan' => 'Semoga bantuan ini bermanfaat untuk korban.', 'status' => 'verified', 'nama' => 'Nadira Putri'],
            ['program' => 'Darurat Banjir Bandang Landak: Air Bersih & Obat-obatan', 'nominal' => 1000000, 'metode' => 'dana', 'pesan' => 'Ikhlas dari hati, semoga membantu.', 'status' => 'pending', 'nama' => 'Fadel Rahman'],
            ['program' => 'Patungan Sembako & Kasur Panti Asuhan Ahmad Yani', 'nominal' => 150000, 'metode' => 'transfer_mandiri', 'pesan' => null, 'status' => 'pending', 'nama' => null], // anonim
            ['program' => 'Perawatan Lansia Panti Jompo Kasih Ibu Pontianak', 'nominal' => 750000, 'metode' => 'ovo', 'pesan' => 'Semoga segera teratasi, aamiin.', 'status' => 'verified', 'nama' => 'Aurelia Zhafira'],
        ];

        foreach ($data as $d) {
            DB::table('donasi_dana')->insert([
                'id_user'      => $userId,
                'id_program'   => $programs[$d['program']] ?? null,
                'id_target'    => $targets[$d['program']] ?? null,
                'nominal'      => $d['nominal'],
                'metode_bayar' => $d['metode'],
                'pesan'        => $d['pesan'],
                'anonim'       => is_null($d['nama']),
                'status'       => $d['status'],
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}