<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonasiDana;
use App\Models\DonasiBarang;
use App\Models\Feedback;
use App\Models\ProgramDonasi;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_donasi_dana'     => DonasiDana::count(),
            'pending_donasi_dana'   => DonasiDana::where('status', 'pending')->count(),
            'total_donasi_barang'   => DonasiBarang::count(),
            'pending_donasi_barang' => DonasiBarang::where('status', 'pending')->count(),
            'total_program'         => ProgramDonasi::count(),
            'total_feedback'        => Feedback::count(),
            'total_user'            => User::where('role', 'user')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function donasiDana()
    {
        $donasi = DonasiDana::latest()->paginate(20);
        return view('admin.donasi-dana', compact('donasi'));
    }

    public function verifikasiDonasi(DonasiDana $donasi)
    {
        $donasi->update(['status' => 'verified']);
        return back()->with('success', 'Donasi berhasil diverifikasi.');
    }

    public function tolakDonasi(DonasiDana $donasi)
    {
        $donasi->update(['status' => 'ditolak']);
        return back()->with('success', 'Donasi berhasil ditolak.');
    }

    public function donasiBarang()
    {
        $barang = DonasiBarang::latest()->paginate(20);
        return view('admin.donasi-barang', compact('barang'));
    }

    public function verifikasiBarang(DonasiBarang $barang)
    {
        $barang->update(['status' => 'diterima']);
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
        return view('admin.feedback', compact('feedbacks'));
    }

    public function hapusFeedback(Feedback $feedback)
    {
        $feedback->delete();
        return back()->with('success', 'Feedback berhasil dihapus.');
    }
}