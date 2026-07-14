@extends('layouts.admin')
@section('title', 'Dashboard Utama')

@section('admin-content')
<div class="space-y-12 pb-12">
    
    {{-- HERO SECTION UTK ADMIN (Senada dengan Gaya User) --}}
    <header class="relative overflow-hidden py-12 px-6 rounded-3xl bg-white border border-slate-200/80 shadow-sm">
        <div class="absolute inset-0 bg-gradient-to-tr from-emerald-50/40 to-slate-50/30 -z-10"></div>
        <div class="grid lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-8 space-y-4 text-left">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-100">
                    ✦ Panel Manajemen Pusat
                </span>
                <h1 class="text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight">
                    Kendali Kontrol,<br>
                    <span class="text-emerald-600">Maksimalkan</span> <span class="text-emerald-900 underline decoration-emerald-100 underline-offset-4">Penyaluran Kebaikan</span>
                </h1>
                <p class="text-sm text-slate-600 max-w-xl leading-relaxed">
                    Selamat datang di ruang kendali Mari Berbagi. Validasi transaksi masuk, pantau ketersediaan logistik bantuan barang, dan kelola keluhan publik secara berkala di sini.
                </p>
            </div>
            <div class="lg:col-span-4 hidden lg:block relative">
                <div class="absolute inset-0 bg-gradient-to-tr from-emerald-100 to-emerald-50 rounded-2xl rotate-2 scale-105 blur-sm opacity-40"></div>
                <div class="relative bg-emerald-800 rounded-2xl p-6 text-white text-center shadow-lg">
                    <span class="text-4xl block mb-2">🛡️</span>
                    <h4 class="font-bold text-lg">Mode Administrator</h4>
                    <p class="text-[11px] text-emerald-100 mt-1">Gunakan hak akses dengan bijak untuk memelihara transparansi platform donasi.</p>
                </div>
            </div>
        </div>
    </header>

    {{-- STATS STRIP SECTION (Mengadopsi Desain Angka Megah) --}}
    <section class="rounded-3xl bg-emerald-800 py-8 px-6 text-white shadow-md shadow-emerald-800/10">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 text-center">
            <div class="border-r border-emerald-700/60 last:border-0">
                <p class="text-2xl sm:text-3xl font-extrabold tracking-tight">{{ $stats['total_donasi_dana'] }}</p>
                <p class="text-[10px] font-bold text-emerald-100 uppercase tracking-wider mt-1">Total Transaksi Dana</p>
                <div class="inline-block bg-amber-500/20 text-amber-300 font-medium px-2 py-0.5 rounded text-[9px] mt-2">
                    ⚠️ {{ $stats['pending_donasi_dana'] }} Menunggu Verifikasi
                </div>
            </div>
            <div class="border-r border-emerald-700/60 lg:last:border-0">
                <p class="text-2xl sm:text-3xl font-extrabold tracking-tight">{{ $stats['total_donasi_barang'] }}</p>
                <p class="text-[10px] font-bold text-emerald-100 uppercase tracking-wider mt-1">Total Paket Barang</p>
                <div class="inline-block bg-amber-500/20 text-amber-300 font-medium px-2 py-0.5 rounded text-[9px] mt-2">
                    ⚠️ {{ $stats['pending_donasi_barang'] }} Belum Dicek
                </div>
            </div>
            <div class="border-r border-emerald-700/60 last:border-0">
                <p class="text-2xl sm:text-3xl font-extrabold tracking-tight">{{ $stats['total_program'] }}</p>
                <p class="text-[10px] font-bold text-emerald-100 uppercase tracking-wider mt-1">Program Aktif</p>
                <div class="inline-block bg-emerald-700 text-emerald-200 font-medium px-2 py-0.5 rounded text-[9px] mt-2">
                    📋 Terdaftar Publik
                </div>
            </div>
            <div>
                <p class="text-2xl sm:text-3xl font-extrabold tracking-tight">{{ $stats['total_feedback'] }}</p>
                <p class="text-[10px] font-bold text-emerald-100 uppercase tracking-wider mt-1">Umpan Balik Publik</p>
                <div class="inline-block bg-emerald-700 text-emerald-200 font-medium px-2 py-0.5 rounded text-[9px] mt-2">
                    ⭐ Komentar Masuk
                </div>
            </div>
        </div>
    </section>

    {{-- QUICK NAVIGATION CONTROL FOR ADMIN (Kembaran Menu 'Mau Ngapain Hari ini') --}}
    <section class="space-y-4">
        <div class="text-left">
            <h2 class="text-xl font-bold text-slate-900 tracking-tight">Navigasi Cepat Kontrol Admin</h2>
            <p class="text-xs text-slate-500">Kelola dan proses basis data aksi kemanusiaan</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.donasi-dana') }}" class="bg-white p-5 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md hover:border-emerald-600 transition flex items-center space-x-4 group">
                <span class="text-2xl bg-slate-50 p-3 rounded-xl group-hover:scale-110 transition-transform">💳</span>
                <div>
                    <h3 class="font-bold text-emerald-800 text-sm">Validasi Dana</h3>
                    <p class="text-[11px] text-slate-500 mt-0.5">Cek bukti transfer masuk</p>
                </div>
            </a>
            <a href="{{ route('admin.donasi-barang') }}" class="bg-white p-5 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md hover:border-emerald-600 transition flex items-center space-x-4 group">
                <span class="text-2xl bg-slate-50 p-3 rounded-xl group-hover:scale-110 transition-transform">📦</span>
                <div>
                    <h3 class="font-bold text-emerald-800 text-sm">Validasi Barang</h3>
                    <p class="text-[11px] text-slate-500 mt-0.5">Verifikasi logistik bantuan</p>
                </div>
            </a>
            <a href="{{ route('admin.feedback') }}" class="bg-white p-5 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md hover:border-emerald-600 transition flex items-center space-x-4 group">
                <span class="text-2xl bg-slate-50 p-3 rounded-xl group-hover:scale-110 transition-transform">⭐</span>
                <div>
                    <h3 class="font-bold text-emerald-800 text-sm">Umpan Balik</h3>
                    <p class="text-[11px] text-slate-500 mt-0.5">Moderasi komentar publik</p>
                </div>
            </a>
            <a href="{{ route('admin.users') }}" class="bg-white p-5 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md hover:border-emerald-600 transition flex items-center space-x-4 group">
                <span class="text-2xl bg-slate-50 p-3 rounded-xl group-hover:scale-110 transition-transform">👥</span>
                <div>
                    <h3 class="font-bold text-emerald-800 text-sm">Manajemen User</h3>
                    <p class="text-[11px] text-slate-500 mt-0.5">Daftar akun terregistrasi</p>
                </div>
            </a>
        </div>
    </section>

    {{-- VISUAL CHART KEBUTUHAN DATA URGENT --}}
    <section class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm max-w-2xl space-y-4">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">📊 Grafik Panti/Bencana Paling Mendesak</h4>
            <span class="text-[10px] px-2 py-0.5 bg-rose-50 text-rose-700 font-semibold rounded">Prioritas Utama</span>
        </div>
        <div class="space-y-4 pt-1">
            <div>
                <div class="flex justify-between text-xs font-medium mb-1.5">
                    <span class="text-slate-700 font-semibold">Kebakaran Siantan</span>
                    <span class="text-rose-600 font-bold">85% Urgen</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2.5">
                    <div class="bg-gradient-to-r from-rose-500 to-rose-400 h-2.5 rounded-full" style="width: 85%"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between text-xs font-medium mb-1.5">
                    <span class="text-slate-700 font-semibold">Banjir Pontianak Barat</span>
                    <span class="text-amber-600 font-bold">60% Urgen</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2.5">
                    <div class="bg-gradient-to-r from-amber-500 to-amber-400 h-2.5 rounded-full" style="width: 60%"></div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection