<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;

class DonasiController extends Controller
{
    // Daftar tujuan pembayaran untuk setiap metode.
    // Silakan ganti nomor rekening/e-wallet sesuai data asli kamu.
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
        // FIX: cegah user mengakses halaman ini langsung tanpa mengisi form donasi dulu
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

        // FIX: ambil info tujuan pembayaran sesuai metode yang dipilih,
        // lalu kirim ke view supaya tidak hardcode lagi
        $info = $this->infoPembayaran[$donasi->metode_pembayaran] ?? [
            'tipe' => 'bank', 'tujuan' => '-', 'label' => 'Tujuan Pembayaran',
        ];

        return view('donasi.pembayaran_instruksi', [
            'donasi' => $donasi,
            'info'   => $info,
        ]);
    }

    // FUNGSI BARU: dipanggil saat user klik "Saya Sudah Melakukan Pembayaran"
    public function selesai()
    {
        $id = session('donasi_id');
        $donasi = Donasi::find($id);

        if ($donasi) {
             return redirect()->route('donasi.create')->with('error', 'Sesi habis, silakan mulai ulang.');
        }

        
        $request->validate([
            // Terima file gambar (jpg/png) atau pdf, maksimal 2MB
            'bukti' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ], [
            'bukti.required' => 'Mohon upload bukti transfer terlebih dahulu.',
            'bukti.mimes'    => 'File harus berformat JPG, PNG, atau PDF.',
            'bukti.max'      => 'Ukuran file maksimal 2MB.',
        ]);

        $path = $request->file('bukti')->store('bukti_pembayaran', 'public');
 
        $donasi->update([
            'bukti_pembayaran' => $path,
            'status'           => 'menunggu_verifikasi',
        ]);
 
        session()->forget('donasi_id');
 
        return redirect()->route('donasi.terimakasih', $donasi->id);
    }
 
    // Halaman konfirmasi setelah bukti transfer berhasil diupload
    public function terimakasih($id)
    {
        $donasi = Donasi::findOrFail($id);
 
        return view('donasi.terimakasih', ['donasi' => $donasi]);
    }
}