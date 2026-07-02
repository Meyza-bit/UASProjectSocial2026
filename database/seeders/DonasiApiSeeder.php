<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonasiApiSeeder extends Seeder
{
    public function run(): void
    {
        $users    = DB::table('users')->pluck('id', 'email');
        $programs = DB::table('program_donasi')->pluck('id', 'judul');
        $targets  = DB::table('target_penerima')->pluck('id_target', 'nama_target');

        DB::table('donasi_dana')->insert([
            [
                'id_user'      => $users['budi@donasi.com'],
                'id_program'   => $programs['Bantuan Darurat Gempa Cianjur'],
                'id_target'    => $targets['Korban Gempa Cianjur'],
                'nominal'      => 500000,
                'metode_bayar' => 'transfer_bca',
                'pesan'        => 'Semoga cepat pulih ya.',
                'anonim'       => false,
                'status'       => 'verified',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'id_user'      => $users['siti@donasi.com'],
                'id_program'   => $programs['Peduli Banjir Jakarta'],
                'id_target'    => $targets['Korban Banjir Jakarta'],
                'nominal'      => 250000,
                'metode_bayar' => 'gopay',
                'pesan'        => 'Semoga bantuan ini bermanfaat.',
                'anonim'       => false,
                'status'       => 'verified',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'id_user'      => $users['andi@donasi.com'],
                'id_program'   => $programs['Tanggap Darurat Erupsi Merapi'],
                'id_target'    => $targets['Korban Erupsi Merapi'],
                'nominal'      => 1000000,
                'metode_bayar' => 'dana',
                'pesan'        => null,
                'anonim'       => true,
                'status'       => 'verified',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}