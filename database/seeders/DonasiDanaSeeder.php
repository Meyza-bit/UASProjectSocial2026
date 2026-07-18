<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonasiDanaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('donasi_dana')->insert([
            [
                'nominal'          => 500000,
                'metode_bayar'     => 'transfer_bca',
                'pesan'            => 'Semoga cepat pulih ya, tetap semangat.',
                'status'           => 'verified',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'nominal'          => 250000,
                'metode_bayar'     => 'gopay',
                'pesan'            => 'Semoga bantuan ini bermanfaat untuk korban.',
                'status'           => 'verified',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'nominal'          => 1000000,
                'metode_bayar'     => 'dana',
                'pesan'            => 'Ikhlas dari hati, semoga membantu.',
                'status'           => 'pending',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'nominal'          => 150000,
                'metode_bayar'     => 'transfer_mandiri',
                'pesan'            => null,
                'status'           => 'pending',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'nominal'          => 750000,
                'metode_bayar'     => 'ovo',
                'pesan'            => 'Semoga segera teratasi, aamiin.',
                'status'          => 'verified',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ]);
    }
}