<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * ==========================================
     * SECTION: AUTENTIKASI (LOGIN & LOGOUT)
     * ==========================================
     */

    /**
     * Menampilkan halaman login (Frontend)
     */
    public function showLogin()
    {
        // Mengarah ke folder resources/views/auth/login.blade.php
        return view('login.login');
    }

    /**
     * Menangani data ketika tombol 'Masuk Sekarang' diklik
     */
    public function login(Request $request)
    {
        // Validasi input form standar
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Proses pencocokan ke database
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Redirect sesuai role user yang login
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('home');
        }

        // Jika gagal, balikkan eror ke frontend
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    /**
     * Menangani proses keluar akun (Logout)
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    /**
     * ==========================================
     * SECTION: PENDAFTARAN AKUN (REGISTER)
     * ==========================================
     */

    /**
     * Menampilkan halaman registrasi (Frontend)
     */
    public function showRegister()
    {
        // Mengarah ke folder resources/views/auth/register.blade.php
        return view('login.register');
    }

    /**
     * Menangani data ketika tombol 'Daftar Akun' diklik
     */
    public function register(Request $request)
    {
        // Validasi data input pendaftaran
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Harus cocok dengan input password_confirmation
        ]);

        // Membuat user baru ke dalam database tabel 'users'
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password biar aman
        ]);

        // Otomatis bikin user langsung login setelah sukses mendaftar
        Auth::login($user);

        // Lempar kembali ke halaman Beranda
        return redirect()->route('home');
    }
}