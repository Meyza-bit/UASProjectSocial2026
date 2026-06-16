@extends('layouts.app')

@section('title', 'Transparansi Penyaluran Dana — Mari Berbagi')

@section('content')
<section class="py-12 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        {{-- SECTION 1: HEADER HALAMAN --}}
        <div class="border-b border-slate-200 pb-5">
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Transparansi Penyaluran Dana</h1>
            <p class="text-xs text-slate-500 mt-1">Laporan distribusi dana donasi secara terbuka, riil, dan akuntabel dari setiap program MariBerbagi.</p>
        </div>

        {{-- SECTION 2: STATISTIK TOTAL KEUANGAN PLATFORM (GRID CARDS) --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm space-y-1">
                <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Total Dana Masuk</p>
                <p class="text-xl sm:text-2xl font-black text-emerald-800">{{ $ringkasan['total_donasi'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm space-y-1">
                <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Dana Disalurkan</p>
                <p class="text-xl sm:text-2xl font-black text-slate-800">{{ $ringkasan['dana_disalurkan'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm space-y-1">
                <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Target Program Terbantu</p>
                <p class="text-xl sm:text-2xl font-black text-slate-800">{{ $ringkasan['program_dibantu'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm space-y-1">
                <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Donatur Terverifikasi</p>
                <p class="text-xl sm:text-2xl font-black text-slate-800">{{ $ringkasan['donatur_aktif'] }}</p>
            </div>
        </div>

        {{-- SECTION 3: TABEL DATA TRANSPARANSI INTEGRASI --}}
        <div class="bg-white border border-slate-200/60 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <h2 class="font-bold text-sm sm:text-base text-slate-900">Alokasi Dana Program Aktif</h2>
                <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md uppercase tracking-wider">
                    🔄 Diperbarui Berkala
                </span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50 text-slate-500 uppercase font-bold tracking-wider">
                            <th class="px-6 py-3.5">Tanggal Distribusi</th>
                            <th class="px-6 py-3.5">Nama Program yang Dibantu</th>
                            <th class="px-6 py-3.5">Kategori</th>
                            <th class="px-6 py-3.5">Dana Cair</th>
                            <th class="px-6 py-3.5">Pihak Penerima</th>
                            <th class="px-6 py-3.5 text-center">Status Berkas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600 font-medium">
                        @foreach($riwayat_penyaluran as $laporan)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-slate-400">{{ $laporan['tanggal'] }}</td>
                            <td class="px-6 py-4 font-bold text-slate-900 max-w-sm sm:max-w-md leading-relaxed">
                                {{ $laporan['program'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-0.5 rounded-md text-[9px] font-extrabold uppercase tracking-wide {{ $laporan['kategori'] === 'Bencana Alam' ? 'bg-red-50 text-red-700' : 'bg-emerald-50 text-emerald-700' }}">
                                    {{ $laporan['kategori'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-extrabold text-slate-800">{{ $laporan['jumlah'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 font-semibold">{{ $laporan['penerima'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="bg-emerald-800 text-white px-2.5 py-1 rounded-lg text-[10px] font-bold inline-flex items-center gap-1 shadow-sm">
                                    ✓ {{ $laporan['status'] }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>
@endsection