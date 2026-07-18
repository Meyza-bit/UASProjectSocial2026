<?php

namespace App\Http\Controllers;

use App\Models\ProgramDonasi;
use App\Models\DonasiDana;
use App\Models\DonasiBarang;
use App\Models\PenyaluranDana;

class TransparansiController extends Controller
{
    public function index()
    {
        // Daftar donasi dana yang sudah terverifikasi & boleh tampil publik
        $donasiMasuk = DonasiDana::with('user')
            ->where('status', 'verified')
            ->tampilPublik()
            ->latest()
            ->take(20)
            ->get();

        // Daftar donasi barang yang sudah diterima & boleh tampil publik
        $donasiBarang = DonasiBarang::with(['user', 'programDonasi', 'itemBarang'])
            ->diterima()
            ->tampilPublik()
            ->latest()
            ->take(20)
            ->get();

        // Riwayat penyaluran dana ke program/penerima
        $penyaluran = PenyaluranDana::with('program')
            ->latest('tanggal_penyaluran')
            ->take(20)
            ->get();

        // Ringkasan angka total (tetap hitung dari SEMUA yang verified/diterima,
        // bukan cuma yang tampil publik, biar angkanya tetap akurat)
        $totalDanaTerkumpul = DonasiDana::where('status', 'verified')->sum('nominal');
        $totalDanaTersalurkan = PenyaluranDana::sum('jumlah');
        $totalDonatur = DonasiDana::where('status', 'verified')->distinct('id_user')->count('id_user');
        $totalDonasiBarang = DonasiBarang::diterima()->count();

        return view('transparansi', compact(
            'donasiMasuk',
            'donasiBarang',
            'penyaluran',
            'totalDanaTerkumpul',
            'totalDanaTersalurkan',
            'totalDonatur',
            'totalDonasiBarang'
        ));
    }

    /**
     * Halaman admin: semua donasi dana verified + barang diterima,
     * lengkap dengan status tampil_publik-nya, buat di-toggle.
     * (Sengaja TIDAK pakai scope tampilPublik() di sini, karena admin
     * justru perlu lihat yang lagi disembunyikan juga supaya bisa dimunculkan lagi.)
     */
    public function admin()
    {
        $dana = DonasiDana::with('user')
            ->where('status', 'verified')
            ->latest()
            ->paginate(15, ['*'], 'dana_page');

        $barang = DonasiBarang::with(['programDonasi', 'itemBarang'])
            ->diterima()
            ->latest()
            ->paginate(15, ['*'], 'barang_page');

        return view('admin.transparansi', compact('dana', 'barang'));
    }

    /**
     * Toggle tampil/sembunyi untuk satu entri donasi dana.
     */
    public function toggleDana(DonasiDana $donasi)
    {
        $donasi->update(['tampil_publik' => ! $donasi->tampil_publik]);

        return back()->with('success', 'Status tampilan donasi dana berhasil diubah.');
    }

    /**
     * Toggle tampil/sembunyi untuk satu entri donasi barang.
     */
    public function toggleBarang(DonasiBarang $barang)
    {
        $barang->update(['tampil_publik' => ! $barang->tampil_publik]);

        return back()->with('success', 'Status tampilan donasi barang berhasil diubah.');
    }
}