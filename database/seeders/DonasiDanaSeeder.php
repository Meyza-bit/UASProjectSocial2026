<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonasiDanaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('donasi')->insert([
            [
                'name'              => 'Budi Santoso',
                'amount'            => 500000,
                'message'           => 'Semoga cepat pulih ya, tetap semangat.',
                'metode_pembayaran' => 'BCA',
                'bukti_pembayaran'  => null,
                'status'            => 'menunggu_verifikasi',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Siti Rahma',
                'amount'            => 250000,
                'message'           => 'Semoga bantuan ini bermanfaat untuk korban.',
                'metode_pembayaran' => 'GoPay',
                'bukti_pembayaran'  => null,
                'status'            => 'menunggu_verifikasi',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Andi Saputra',
                'amount'            => 1000000,
                'message'           => 'Ikhlas dari hati, semoga membantu.',
                'metode_pembayaran' => 'DANA',
                'bukti_pembayaran'  => null,
                'status'            => 'pending',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Rina Putri',
                'amount'            => 150000,
                'message'           => null,
                'metode_pembayaran' => 'Mandiri',
                'bukti_pembayaran'  => null,
                'status'            => 'pending',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Dewi Lestari',
                'amount'            => 750000,
                'message'           => 'Semoga segera teratasi, aamiin.',
                'metode_pembayaran' => 'OVO',
                'bukti_pembayaran'  => null,
                'status'            => 'menunggu_verifikasi',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}