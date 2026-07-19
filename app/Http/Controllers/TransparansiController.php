<?php

namespace App\Http\Controllers;

use App\Models\DonasiDana;
use App\Models\DonasiBarang;
use App\Models\PenyaluranDana;
use App\Models\PenyaluranBarang;

class TransparansiController extends Controller
{
    public function index()
    {
        // Daftar donasi dana yang sudah terverifikasi
        $donasiMasuk = DonasiDana::with('user')
            ->where('status', 'verified')
            ->latest()
            ->take(20)
            ->get();

        // Daftar donasi barang yang sudah diterima
        $donasiBarang = DonasiBarang::with(['user', 'programDonasi', 'itemBarang'])
            ->diterima()
            ->latest()
            ->take(20)
            ->get();

        // Ambil penyaluran dana, tandai tipenya
        $penyaluranDana = PenyaluranDana::with('program')->get()->map(function ($item) {
            $item->tipe = 'dana';
            return $item;
        });

        // Ambil penyaluran barang, tandai tipenya
        $penyaluranBarang = PenyaluranBarang::with('program')->get()->map(function ($item) {
            $item->tipe = 'barang';
            return $item;
        });

        // Gabung dua koleksi jadi satu, urutkan dari yang terbaru
        $riwayatPenyaluran = $penyaluranDana->concat($penyaluranBarang)
            ->sortByDesc('tanggal_penyaluran')
            ->take(20)
            ->values();

        // Ringkasan angka total
        $totalDanaTerkumpul = DonasiDana::where('status', 'verified')->sum('nominal');
        $totalDanaTersalurkan = PenyaluranDana::sum('jumlah');
        $totalDonatur = DonasiDana::where('status', 'verified')->distinct('id_user')->count('id_user');
        $totalDonasiBarang = DonasiBarang::diterima()->count();

        return view('transparansi', compact(
            'donasiMasuk',
            'donasiBarang',
            'riwayatPenyaluran',
            'totalDanaTerkumpul',
            'totalDanaTersalurkan',
            'totalDonatur',
            'totalDonasiBarang'
        ));
    }
}