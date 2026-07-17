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
        $donasi->update(['status' => 'terverifikasi']);
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

        return view('admin.feedback', [
            'feedbacks' => $feedbacks,
            'feedback'  => $feedbacks,
        ]);
    }

    public function hapusFeedback(Feedback $feedback)
    {
        $feedback->delete();
        return back()->with('success', 'Feedback berhasil dihapus.');
    }

    public function profile()
    {
        return view('admin.profile', ['user' => auth()->user()]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ]);

        auth()->user()->update($request->only('name', 'email'));

        return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (!\Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        auth()->user()->update(['password' => \Hash::make($request->password)]);

        return redirect()->route('admin.profile')->with('success', 'Password berhasil diperbarui.');
    }


}