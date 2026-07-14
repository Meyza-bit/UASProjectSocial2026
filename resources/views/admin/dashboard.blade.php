@extends('layouts.admin')
@section('title', 'Dashboard Utama')

@section('admin-content')
<div class="space-y-6">
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm space-y-1">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Transaksi Dana</p>
            <h3 class="text-xl font-extrabold text-slate-900">{{ $stats['total_donasi_dana'] }}</h3>
            <p class="text-[10px] text-amber-600 font-medium">⚠️ {{ $stats['pending_donasi_dana'] }} Menunggu Verifikasi</p>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm space-y-1">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Paket Barang</p>
            <h3 class="text-xl font-extrabold text-slate-900">{{ $stats['total_donasi_barang'] }}</h3>
            <p class="text-[10px] text-amber-600 font-medium">⚠️ {{ $stats['pending_donasi_barang'] }} Belum Dicek</p>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm space-y-1">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Program Aktif</p>
            <h3 class="text-xl font-extrabold text-slate-900">{{ $stats['total_program'] }} <span class="text-xs font-normal text-slate-500">Program</span></h3>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm space-y-1">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Umpan Balik Publik</p>
            <h3 class="text-xl font-extrabold text-slate-900">{{ $stats['total_feedback'] }} <span class="text-xs font-normal text-slate-500">Komentar</span></h3>
        </div>
    </div>

    {{-- Kebutuhan Grafik Visual 2.1.2.a --}}
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4 max-w-2xl">
        <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">📊 Grafik Panti/Bencana Paling Mendesak</h4>
        <div class="space-y-3 pt-1">
            <div>
                <div class="flex justify-between text-xs font-medium mb-1">
                    <span class="text-slate-700">Kebakaran Siantan</span>
                    <span class="text-rose-600 font-bold">85% Urgen</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2"><div class="bg-rose-500 h-2 rounded-full" style="width: 85%"></div></div>
            </div>
            <div>
                <div class="flex justify-between text-xs font-medium mb-1">
                    <span class="text-slate-700">Banjir Pontianak Barat</span>
                    <span class="text-amber-600 font-bold">60% Urgen</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2"><div class="bg-amber-500 h-2 rounded-full" style="width: 60%"></div></div>
            </div>
        </div>
    </div>
</div>
@endsection