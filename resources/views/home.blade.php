@extends('layouts.app')

@section('title', 'Mari Berbagi — Bersama Kita Bisa')

@section('content')
    {{-- HERO SECTION --}}
    <header class="relative overflow-hidden py-16 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-100">
                    ✦ Platform Donasi Bencana Terpercaya
                </span>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-slate-900 tracking-tight leading-none">
                    Satu Aksi,<br>
                    <span class="text-emerald-600">Ribuan</span> <span class="text-emerald-900 underline decoration-emerald-100 underline-offset-4">Harapan</span>
                </h1>
                <p class="text-base sm:text-lg text-slate-600 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                    Mari Berbagi menghubungkan donatur dengan korban bencana secara langsung, transparan, dan terpercaya di seluruh Indonesia.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-2">
                    <a href="{{ Route::has('donasi.create') ? route('donasi.create') : '#' }}" class="bg-emerald-800 hover:bg-emerald-700 text-white text-center px-8 py-3.5 rounded-xl font-bold text-base transition shadow-lg shadow-emerald-800/20">
                        ♥ Donasi Sekarang
                    </a>
                    <a href="{{ Route::has('program.index') ? route('program.index') : '#program-pilihan' }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-center px-8 py-3.5 rounded-xl font-semibold text-base transition">
                       Lihat Program
                    </a>
                </div>
            </div>
            <div class="lg:col-span-5 relative">
                <div class="absolute inset-0 bg-gradient-to-tr from-emerald-100 to-emerald-50 rounded-3xl rotate-2 scale-105 blur-sm opacity-40"></div>
                <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1200&auto=format&fit=crop" 
                     alt="Aksi Kemanusiaan Mariberbagi" 
                     class="relative rounded-3xl shadow-xl w-full object-cover h-[350px] sm:h-[420px] border border-slate-100">
            </div>
        </div>
    </header>

    {{-- STATS STRIP SECTION --}}
    <section class="border-y border-slate-100 bg-emerald-800 py-10 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <p class="text-3xl font-extrabold">Rp 4,8M+</p>
                    <p class="text-xs font-medium text-emerald-100 uppercase tracking-wider mt-1">Dana Tersalurkan</p>
                </div>
                <div>
                    <p class="text-3xl font-extrabold">12.400+</p>
                    <p class="text-xs font-medium text-emerald-100 uppercase tracking-wider mt-1">Donatur Bergabung</p>
                </div>
                <div>
                    <p class="text-3xl font-extrabold">340+</p>
                    <p class="text-xs font-medium text-emerald-100 uppercase tracking-wider mt-1">Program Berhasil</p>
                </div>
                <div>
                    <p class="text-3xl font-extrabold">98%</p>
                    <p class="text-xs font-medium text-emerald-100 uppercase tracking-wider mt-1">Tingkat Kepuasan</p>
                </div>
            </div>
        </div>
    </section>

    {{-- QUICK NAV SECTION --}}
    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Mau Ngapain Hari Ini?</h2>
                <p class="text-slate-500 mt-2">Pilih fitur yang kamu butuhkan</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                <!-- Link Program -->
                <a href="{{ Route::has('program.index') ? route('program.index') : '#program-pilihan' }}" class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md hover:border-emerald-600 transition text-center flex flex-col items-center justify-center space-y-3 group">
                    <span class="text-3xl group-hover:scale-110 transition-transform">📋</span>
                    <h3 class="font-bold text-emerald-800 text-base">Lihat Program</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Katalog program bencana yang butuh bantuan</p>
                </a>
                <!-- Link Donasi -->
                <a href="{{ Route::has('donasi.create') ? route('donasi.create') : '#' }}" class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md hover:border-emerald-600 transition text-center flex flex-col items-center justify-center space-y-3 group">
                    <span class="text-3xl group-hover:scale-110 transition-transform">💳</span>
                    <h3 class="font-bold text-emerald-800 text-base">Donasi Dana</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Kirim bantuan uang via transfer atau e-wallet</p>
                </a>
                <!-- Link Kirim Barang -->
                <a href="{{ Route::has('barang.create') ? route('barang.create') : '#' }}" class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md hover:border-emerald-600 transition text-center flex flex-col items-center justify-center space-y-3 group">
                    <span class="text-3xl group-hover:scale-110 transition-transform">📦</span>
                    <h3 class="font-bold text-emerald-800 text-base">Kirim Barang</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Input data barang logistik untuk dikirim</p>
                </a>
                <!-- Link Transparansi -->
                <a href="{{ Route::has('transparansi') ? route('transparansi') : '#' }}" class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md hover:border-emerald-600 transition text-center flex flex-col items-center justify-center space-y-3 group">
                    <span class="text-3xl group-hover:scale-110 transition-transform">📊</span>
                    <h3 class="font-bold text-emerald-800 text-base">Transparansi</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Lihat riwayat donasi secara publik</p>
                </a>
                <!-- Link Ulasan / Feedback -->
                <a href="{{ Route::has('feedback.index') ? route('feedback.index') : '#' }}" class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md hover:border-emerald-600 transition text-center flex flex-col items-center justify-center space-y-3 group">
                    <span class="text-3xl group-hover:scale-110 transition-transform">⭐</span>
                    <h3 class="font-bold text-emerald-800 text-base">Ulasan</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Baca & tulis ulasan dari donatur lain</p>
                </a>
            </div>
        </div>
    </section>

    {{-- DYNAMIC PROGRAM CARDS SECTION --}}
    <section id="program-pilihan" class="py-16 bg-slate-100/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-10 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Program Donasi Pilihan</h2>
                    <p class="text-slate-500 mt-1">Bantuan mendesak yang membutuhkan uluran tangan kita bersama hari ini.</p>
                </div>
                <a href="{{ Route::has('program.index') ? route('program.index') : '#' }}" class="text-sm font-semibold text-emerald-800 hover:text-emerald-900 flex items-center gap-1 group whitespace-nowrap">
                    Lihat Semua Program <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($programs as $item)
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/60 shadow-sm hover:shadow-lg transition flex flex-col">
                    <img src="{{ $item->gambar ?: 'https://images.unsplash.com/photo-1594897030264-ab7d87efc473?q=80&w=600&auto=format&fit=crop' }}" 
                         alt="{{ $item->judul }}" class="h-48 w-full object-cover">
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                        <div class="space-y-2">
                            <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-700">
                                {{ $item->kategori }}
                            </span>
                            <h3 class="font-bold text-lg text-slate-900 line-clamp-2">{{ $item->judul }}</h3>
                        </div>
                        
                        <div class="space-y-1.5">
                            <div class="w-full bg-slate-100 rounded-full h-2">
                                <div class="bg-emerald-600/80 h-2 rounded-full" style="width: {{ $item->presentase }}%"></div>
                            </div>
                            <div class="flex justify-between text-xs font-semibold text-slate-500">
                                <span>Terkumpul: <strong class="text-slate-800">Rp {{ number_format($item->dana_terkumpul, 0, ',', '.') }}</strong></span>
                                <span class="text-emerald-700">{{ $item->presentase }}%</span>
                            </div>
                        </div>

                        <div class="pt-2 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <p class="text-[9px] text-slate-400 uppercase tracking-wider font-semibold">Target</p>
                                <p class="text-sm font-bold text-slate-700">Rp {{ number_format($item->target_dana, 0, ',', '.') }}</p>
                            </div>
                            <a href="{{ route('donasi.create', ['program' => $item->id]) }}" class="bg-emerald-800 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition shadow-sm">Donasi</a>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-slate-400 col-span-3 text-center py-12">Belum ada program donasi aktif saat ini.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection