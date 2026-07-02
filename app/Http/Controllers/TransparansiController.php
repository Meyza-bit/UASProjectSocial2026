<?php

namespace App\Http\Controllers;

use App\Models\DonasiDana;
use App\Models\DonasiBarang;

class TransparansiController extends Controller
{
    public function index()
    {
        $donasiDana = DonasiDana::with(['user', 'program', 'targetPenerima'])
            ->where('status', 'verified')
            ->latest()
            ->get();

        $donasiBarang = DonasiBarang::with(['user', 'programDonasi', 'itemBarang'])
            ->where('status', 'diterima')
            ->latest()
            ->get();

        $totalDana = $donasiDana->sum('nominal');
        $jumlahProgram = $donasiDana->pluck('id_program')->unique()->count();

        $ringkasan = [
            'total_donasi'    => 'Rp ' . number_format($totalDana, 0, ',', '.'),
            'dana_disalurkan' => 'Rp ' . number_format($totalDana, 0, ',', '.'),
            'program_dibantu' => $jumlahProgram,
            'donatur_aktif'   => $donasiDana->count() + $donasiBarang->count(),
        ];

        $riwayat_penyaluran = $donasiDana->map(function ($d) {
            return [
                'tanggal'  => $d->created_at ? $d->created_at->format('d M Y') : '-',
                'program'  => $d->program ? $d->program->judul : '-',
                'kategori' => $d->program ? $d->program->kategori : '-',
                'jumlah'   => 'Rp ' . number_format($d->nominal, 0, ',', '.'),
                'penerima' => $d->targetPenerima ? $d->targetPenerima->nama_target : '-',
                'status'   => 'Terverifikasi',
            ];
        })->toArray();

        return view('transparansi', compact('ringkasan', 'riwayat_penyaluran'));
    }
}