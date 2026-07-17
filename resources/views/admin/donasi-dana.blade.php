@extends('layouts.admin')
@section('title', 'Verifikasi Donasi Dana')

@section('admin-content')
<div class="space-y-6 pb-12">
    
    {{-- ALERT NOTIFIKASI SUKSES / PESAN --}}
    @if(session('success'))
    <div class="flex items-center gap-3 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-800 text-xs font-semibold shadow-sm animate-fade-in">
        <span>✨</span>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    {{-- HEADER KELOLA DANA --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900 tracking-tight">🛡️ Log Validasi Pembukuan & Bukti Transfer</h2>
            <p class="text-xs text-slate-500 mt-0.5">Saring, periksa kesesuaian nominal mutasi rekening, dan lakukan verifikasi transaksi keuangan.</p>
        </div>
        <div class="px-3 py-1.5 bg-white border border-slate-200 rounded-xl text-[11px] font-bold text-slate-600 shadow-sm">
            Total Transaksi: <span class="text-emerald-700 font-extrabold">{{ $donasi->total() }}</span>
        </div>
    </div>

    {{-- TABLE CONTAINER --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden text-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-slate-50 text-slate-400 font-bold uppercase text-[10px] border-b border-slate-200">
                    <tr>
                        <th class="p-4 pl-6">ID Transaksi / Waktu</th>
                        <th class="p-4">Jumlah Dana</th>
                        <th class="p-4">Status Verifikasi</th>
                        <th class="p-4 text-center pr-6">Tindakan Posko</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-600">
                    @forelse($donasi as $d)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        {{-- KOLOM 1: ID TRANSAKSI & WAKTU --}}
                        <td class="p-4 pl-6">
                            <div class="font-bold text-slate-900 text-sm flex items-center gap-1.5">
                                <span class="text-slate-400">#</span>TRX-{{ $d->id }}
                            </div>
                            <div class="text-[10px] text-slate-400 mt-0.5 flex items-center gap-1">
                                📅 {{ $d->created_at->format('d M Y, H:i') }} WIB
                            </div>
                        </td>
                        
                        {{-- KOLOM 2: NOMINAL RUPIAH --}}
                        <td class="p-4">
                            <div class="font-mono font-extrabold text-emerald-800 text-sm">
                                Rp {{ number_format($d->nominal, 0, ',', '.') }}
                            </div>
                           <div class="text-[10px] text-slate-400 mt-0.5">
                                a.n. <span class="font-semibold text-slate-600">{{ $d->anonim ? 'Anonim' : ($d->user->name ?? 'Donatur') }}</span>
                            </div>
                                                    </td>
                        
                        {{-- KOLOM 3: STATUS BADGES --}}
                        <td class="p-4">
                            @if($d->status == 'pending')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    Pending
                                </span>
                            @elseif($d->status == 'verified')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Terverifikasi
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    Ditolak
                                </span>
                            @endif
                        </td>
                        
                        {{-- KOLOM 4: AKSI TOMBOL TINDAKAN --}}
                        <td class="p-4 text-center pr-6">

                            @if($d->bukti_pembayaran)
                                <a href="{{ asset('storage/'.$d->bukti_pembayaran) }}" target="_blank"
                                class="text-emerald-700 underline text-[11px] font-semibold block mb-2">
                                    📎 Lihat Bukti Transfer
                                </a>
                            @else
                                <span class="text-[10px] text-slate-400 block mb-2">Belum ada bukti</span>
                            @endif
                            @if($d->status == 'pending')
                            <div class="flex justify-center items-center gap-2">
                                <!-- Form Verifikasi / Setuju -->
                                <form action="/admin/donasi-dana/{{ $d->id }}/verifikasi" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-emerald-800 hover:bg-emerald-700 text-white font-bold px-3 py-1.5 rounded-xl text-[11px] transition shadow-sm shadow-emerald-800/10 flex items-center gap-1">
                                        ✓ Setujui
                                    </button>
                                </form>
                                <!-- Form Tolak -->
                                <form action="/admin/donasi-dana/{{ $d->id }}/tolak" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-white border border-slate-200 text-rose-600 hover:bg-rose-50/50 hover:border-rose-200 font-bold px-3 py-1.5 rounded-xl text-[11px] transition">
                                        ✕ Tolak
                                    </button>
                                </form>
                            </div>
                            @else
                                @if($d->status == 'verified')
                                    <span class="inline-flex items-center gap-1 text-emerald-700 font-bold bg-emerald-50 px-3 py-1.5 rounded-xl border border-emerald-100">
                                        ✓ Pembukuan Selesai
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-slate-400 font-bold bg-slate-50 px-3 py-1.5 rounded-xl border border-slate-200/60">
                                        ✕ Transaksi Dibatalkan
                                    </span>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-12 text-center text-slate-400">
                            <span class="text-3xl block mb-2">💸</span>
                            <p class="font-medium text-slate-500">Tidak ada riwayat pengajuan donasi dana.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- PAGINATION --}}
        @if($donasi->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            {{ $donasi->links() }}
        </div>
        @endif
    </div>
</div>
@endsection