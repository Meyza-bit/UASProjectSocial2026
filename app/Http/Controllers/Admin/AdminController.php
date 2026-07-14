<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use App\Models\Barang;
use App\Models\Feedback;
use App\Models\ProgramDonasi;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        // AMAN: Menonaktifkan proteksi kolom 'role' yang belum ada di database SQLite kamu
        $stats = [
            'total_donasi_dana'    => Donasi::count(),
            'pending_donasi_dana'  => Donasi::where('status', 'pending')->count(),
            'total_donasi_barang'  => Barang::count(),
            'pending_donasi_barang'=> Barang::where('status', 'pending')->count(),
            'total_program'        => ProgramDonasi::count(),
            'total_feedback'       => Feedback::count(),
            'total_user'           => User::count(), // Diubah dari where('role') menjadi count() biasa agar tidak crash
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function donasiDana()
    {
        // Menggunakan paginate dan memastikan variabel dikirim dalam bentuk jamak/tunggal secara aman
        $donasi = Donasi::latest()->paginate(20);
        return view('admin.donasi-dana', compact('donasi'));
    }

    public function verifikasiDonasi(Donasi $donasi)
    {
        $donasi->update(['status' => 'terverifikasi']);
        return back()->with('success', 'Donasi berhasil diverifikasi.');
    }

    public function tolakDonasi(Donasi $donasi)
    {
        $donasi->update(['status' => 'ditolak']);
        return back()->with('success', 'Donasi berhasil ditolak.');
    }

    public function donasiBarang()
    {
        $barang = Barang::latest()->paginate(20);
        return view('admin.donasi-barang', compact('barang'));
    }

    public function verifikasiBarang(Barang $barang)
    {
        $barang->update(['status' => 'terverifikasi']);
        return back()->with('success', 'Donasi barang berhasil diverifikasi.');
    }

    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function feedback()
    {
        $feedbacks = Feedback::latest()->paginate(20);
        
        // SINKRONISASI: Mengirimkan dua opsi nama variabel (tunggal & jamak) 
        // agar apa pun yang kamu tulis di file feedback.blade.php (baik $feedback atau $feedbacks) tetap terbaca dan TIDAK ERROR
        return view('admin.feedback', [
            'feedbacks' => $feedbacks,
            'feedback'  => $feedbacks
        ]);
    }

    public function hapusFeedback(Feedback $feedback)
    {
        $feedback->delete();
        return back()->with('success', 'Feedback berhasil dihapus.');
    }
}