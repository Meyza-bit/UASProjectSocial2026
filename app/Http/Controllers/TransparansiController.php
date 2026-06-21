<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransparansiController extends Controller
{
    public function index()
    {
        $ringkasan = [
            'total_donasi' => 'Rp 143.500.000',
            'dana_disalurkan' => 'Rp 112.000.000',
            'program_dibantu' => '6 Program',
            'donatur_aktif' => '1.420 Orang'
        ];

        $riwayat_penyaluran = [
            [
                'tanggal' => '15 Juni 2026',
                'program' => 'Bantuan Logistik & Pakaian Layak Pakai Korban Kebakaran Pemukiman Siantan',
                'kategori' => 'Bencana Alam',
                'jumlah' => 'Rp 15.200.000',
                'penerima' => 'Posko Kebakaran Siantan Hulu',
                'status' => 'Disalurkan'
            ],
            [
                'tanggal' => '12 Juni 2026',
                'program' => 'Patungan Sembako & Kasur Layak untuk Anak-Anak Panti Asuhan Ahmad Yani',
                'kategori' => 'Panti Sosial',
                'jumlah' => 'Rp 8.400.000',
                'penerima' => 'Pengurus Panti Ahmad Yani',
                'status' => 'Disalurkan'
            ],
            [
                'tanggal' => '08 Juni 2026',
                'program' => 'Darurat Banjir Bandang Landak: Pengadaan Air Bersih dan Obat-Obatan',
                'kategori' => 'Bencana Alam',
                'jumlah' => 'Rp 24.500.000',
                'penerima' => 'Posko Induk Ngabang',
                'status' => 'Disalurkan'
            ]
        ];

        return view('transparansi', compact('ringkasan', 'riwayat_penyaluran'));
    }
}