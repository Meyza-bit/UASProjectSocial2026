<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenyaluranBarangSeeder extends Seeder
{
    public function run(): void
    {
        $programs = DB::table('program_donasi')->pluck('id', 'judul');

        $data = [
            [
                'program'     => 'Bantuan Logistik Korban Kebakaran Siantan',
                'nama_barang' => 'Selimut',
                'jumlah'      => 20,
                'satuan'      => 'pcs',
                'penerima'    => 'Posko Kebakaran Siantan Hulu',
                'keterangan'  => 'Disalurkan langsung ke posko pengungsian.',
                'tanggal'     => '2026-06-16',
            ],
            [
                'program'     => 'Dapur Umum Korban Banjir Kapuas Pontianak',
                'nama_barang' => 'Beras',
                'jumlah'      => 50,
                'satuan'      => 'kg',
                'penerima'    => 'Warga Desa Tambelan Sampit',
                'keterangan'  => 'Dibagikan ke 25 KK terdampak banjir.',
                'tanggal'     => '2026-06-21',
            ],
            [
                'program'     => 'Darurat Banjir Bandang Landak: Air Bersih & Obat-obatan',
                'nama_barang' => 'Obat-obatan',
                'jumlah'      => 15,
                'satuan'      => 'paket',
                'penerima'    => 'Puskesmas Ngabang',
                'keterangan'  => 'Diserahkan untuk mendukung layanan kesehatan darurat.',
                'tanggal'     => '2026-06-22',
            ],
        ];

        foreach ($data as $d) {
            DB::table('penyaluran_barang')->insert([
                'id_program'         => $programs[$d['program']] ?? null,
                'nama_barang'        => $d['nama_barang'],
                'jumlah'             => $d['jumlah'],
                'satuan'             => $d['satuan'],
                'penerima'           => $d['penerima'],
                'keterangan'         => $d['keterangan'],
                'bukti_penyaluran'   => null,
                'tanggal_penyaluran' => $d['tanggal'],
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);
        }
    }
}