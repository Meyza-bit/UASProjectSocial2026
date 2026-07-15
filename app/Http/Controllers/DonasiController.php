<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;

class DonasiController extends Controller
{
    // Daftar tujuan pembayaran untuk setiap metode.
    private $infoPembayaran = [
        'GoPay'      => ['tipe' => 'ewallet', 'tujuan' => '0812-3456-7890', 'label' => 'Nomor GoPay'],
        'DANA'       => ['tipe' => 'ewallet', 'tujuan' => '0812-3456-7890', 'label' => 'Nomor DANA'],
        'OVO'        => ['tipe' => 'ewallet', 'tujuan' => '0812-3456-7890', 'label' => 'Nomor OVO'],
        'BCA'        => ['tipe' => 'bank', 'tujuan' => '8801 1234 5678', 'label' => 'No. Rekening BCA'],
        'Mandiri'    => ['tipe' => 'bank', 'tujuan' => '113 0099 8877', 'label' => 'No. Rekening Mandiri'],
        'BRI'        => ['tipe' => 'bank', 'tujuan' => '0099 0123 4567', 'label' => 'No. Rekening BRI'],
        'BNI'        => ['tipe' => 'bank', 'tujuan' => '0123 4567 89', 'label' => 'No. Rekening BNI'],
        'BSI'        => ['tipe' => 'bank', 'tujuan' => '7001 2345 678', 'label' => 'No. Rekening BSI'],
        'CIMB Niaga' => ['tipe' => 'bank', 'tujuan' => '8000 1234 5678', 'label' => 'No. Rekening CIMB Niaga'],
    ];

    // Fungsi untuk menampilkan halaman form donasi
    public function create()
    {
        return view('donasi.create');
    }

    public function pembayaran()
    {
        // Cegah user mengakses halaman ini langsung tanpa mengisi form donasi dulu
        if (!session('donasi_id')) {
            return redirect()->route('donasi.create')
                ->with('error', 'Silakan isi data donasi terlebih dahulu.');
        }

        return view('donasi.pembayaran');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'amount'  => 'required|numeric|min:1000',
            'message' => 'nullable|string',
        ]);

        // BUAT RECORD DI DATABASE DULU
        $donasi = Donasi::create([
            'name'    => $request->name,
            'amount'  => $request->amount,
            'message' => $request->message ?? '-',
            'status'  => 'pending',
        ]);

        // SIMPAN ID KE SESSION
        session(['donasi_id' => $donasi->id]);

        return redirect()->route('donasi.pembayaran');
    }

    public function konfirmasi(Request $request)
    {
        // Validasi agar tidak kosong
        $request->validate(['metode' => 'required']);

        $id = session('donasi_id');
        $donasi = Donasi::find($id);

        if ($donasi) {
            $donasi->update(['metode_pembayaran' => $request->metode]);
            return redirect()->route('donasi.instruksi');
        }

        return redirect()->route('donasi.create')->with('error', 'Sesi habis, silakan mulai ulang.');
    }

    public function instruksi()
    {
        $id = session('donasi_id');
        $donasi = Donasi::find($id);

        if (!$donasi || !$donasi->metode_pembayaran) {
            return redirect()->route('donasi.create');
        }

        // Ambil info tujuan pembayaran sesuai metode yang dipilih
        $info = $this->infoPembayaran[$donasi->metode_pembayaran] ?? [
            'tipe' => 'bank', 'tujuan' => '-', 'label' => 'Tujuan Pembayaran',
        ];

        return view('donasi.pembayaran_instruksi', [
            'donasi' => $donasi,
            'info'   => $info,
        ]);
    }

    // FUNGSI BARU: dipanggil saat user klik "Kirim Bukti Pembayaran"
    public function selesai(Request $request)
    {
        $id = session('donasi_id');
        $donasi = Donasi::find($id);

        // Perbaikan logika: Jika donasi TIDAK ditemukan, balikkan ke halaman create
        if (!$donasi) {
             return redirect()->route('donasi.create')->with('error', 'Sesi habis, silakan mulai ulang.');
        }

        // Validasi file bukti transfer
        $request->validate([
            'bukti' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ], [
            'bukti.required' => 'Mohon upload bukti transfer terlebih dahulu.',
            'bukti.mimes'    => 'File harus berformat JPG, PNG, atau PDF.',
            'bukti.max'      => 'Ukuran file maksimal 2MB.',
        ]);

        // Simpan file bukti ke folder storage/app/public/bukti_pembayaran
        $path = $request->file('bukti')->store('bukti_pembayaran', 'public');
 
        // Update database sesuai nama kolom di Model
        $donasi->update([
            'bukti_pembayaran' => $path,
            'status'           => 'menunggu_verifikasi',
        ]);
 
        // Hapus session donasi agar transaksi selesai
        session()->forget('donasi_id');
 
        // Redirect ke halaman terima kasih dengan menyertakan ID donasi
        return redirect()->route('donasi.terimakasih', $donasi->id);
    }
 
    // Halaman konfirmasi setelah bukti transfer berhasil diupload
    public function terimakasih($id)
    {
        $donasi = Donasi::findOrFail($id);
 
        // Dipanggil sesuai nama file view: donasi_terimakasih.blade.php
        return view('donasi.donasi_terimakasih', ['donasi' => $donasi]);
    }
}