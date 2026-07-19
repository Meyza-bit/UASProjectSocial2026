<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenyaluranDana;
use App\Models\PenyaluranBarang;
use App\Models\ProgramDonasi;

class PenyaluranController extends Controller
{
    public function index()
    {
        $programs = ProgramDonasi::orderBy('judul')->get();

        // Ambil semua penyaluran dana, ubah jadi bentuk seragam
        $dana = PenyaluranDana::with('program')->latest('tanggal_penyaluran')->get()
            ->map(function ($item) {
                return [
                    'jenis'       => 'dana',
                    'id'          => $item->id,
                    'program'     => $item->program->judul ?? 'Umum',
                    'tanggal'     => $item->tanggal_penyaluran,
                    'detail'      => 'Rp ' . number_format($item->jumlah, 0, ',', '.'),
                    'keterangan'  => $item->keterangan,
                    'bukti'       => $item->bukti_penyaluran,
                    'hapus_route' => route('admin.penyaluran-dana.destroy', $item->id),
                ];
            });

        // Ambil semua penyaluran barang, ubah jadi bentuk seragam
        $barang = PenyaluranBarang::with('program')->latest('tanggal_penyaluran')->get()
            ->map(function ($item) {
                return [
                    'jenis'       => 'barang',
                    'id'          => $item->id,
                    'program'     => $item->program->judul ?? 'Umum',
                    'tanggal'     => $item->tanggal_penyaluran,
                    'detail'      => "{$item->nama_barang} — {$item->jumlah} {$item->satuan}" . ($item->penerima ? " (untuk {$item->penerima})" : ''),
                    'keterangan'  => $item->keterangan,
                    'bukti'       => $item->bukti_penyaluran,
                    'hapus_route' => route('admin.penyaluran-barang.destroy', $item->id),
                ];
            });

        // Gabung dua-duanya, urutin dari yang paling baru
        $riwayat = $dana->concat($barang)->sortByDesc('tanggal')->values();

        return view('admin.penyaluran', compact('riwayat', 'programs'));
    }
}