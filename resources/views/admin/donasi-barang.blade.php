@extends('layouts.admin')
@section('title', 'Verifikasi Donasi Barang')

@section('admin-content')
<div class="space-y-6 pb-12">
    
    {{-- ALERT NOTIFIKASI SUKSES --}}
    @if(session('success'))
    <div class="flex items-center gap-3 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-800 text-xs font-semibold shadow-sm animate-fade-in">
        <span>✨</span>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    {{-- HEADER KELOLA BARANG --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900 tracking-tight">📦 Log Validasi Barang Logistik</h2>
            <p class="text-xs text-slate-500 mt-0.5">Pantau, cek kondisi fisik, dan verifikasi masuknya paket logistik dari donatur.</p>
        </div>
        <div class="px-3 py-1.5 bg-white border border-slate-200 rounded-xl text-[11px] font-bold text-slate-600 shadow-sm">
            Total Pengajuan: <span class="text-emerald-700 font-extrabold">{{ $barang->total() }}</span>
        </div>
    </div>

    {{-- TABLE CONTAINER --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden text-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-slate-50 text-slate-400 font-bold uppercase text-[10px] border-b border-slate-200">
                    <tr>
                        <th class="p-4 pl-6">Detail Logistik & Donatur</th>
                        <th class="p-4">Kondisi / Kuantitas</th>
                        <th class="p-4">Status Verifikasi</th>
                        <th class="p-4 text-center pr-6">Tindakan Posko</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-600">
                    @forelse($barang as $b)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        {{-- KOLOM 1: DAFTAR BARANG & IDENTITAS PENGIRIM --}}
                        <td class="p-4 pl-6">
                            <div class="font-bold text-slate-900 text-sm flex items-center gap-1.5">
                                <span class="text-base">📦</span>
                                {{ $b->programDonasi->judul ?? 'Program Umum' }}
                            </div>
                            <div class="text-[10px] text-slate-400 mt-0.5 flex items-center gap-1">
                                <span>👤 Pengirim:</span> 
                                <span class="text-slate-600 font-semibold">{{ $b->nama_pengirim ?? 'Anonim' }}</span>
                            </div>
                        </td>
                        
                        {{-- KOLOM 2: RINCIAN BARANG (pcs/karung/kg dst) --}}
                        <td class="p-4">
                            <div class="flex flex-wrap gap-1.5 max-w-xs">
                                @forelse($b->itemBarang as $item)
                                <span class="inline-flex items-center px-2 py-1 rounded-lg bg-slate-100 font-bold text-slate-700 text-[11px]" title="Kondisi: {{ $item->kondisi }}">
                                    🔢 {{ $item->nama_barang }} — {{ $item->jumlah }} {{ $item->satuan }}
                                </span>
                                @empty
                                <span class="text-[10px] text-slate-400 italic">Tidak ada rincian barang</span>
                                @endforelse
                            </div>
                            @if(isset($b->catatan) && $b->catatan !== '')
                                <p class="text-[10px] text-slate-400 mt-1 max-w-xs truncate italic">Note: "{{ $b->catatan }}"</p>
                            @endif
                        </td>
                        
                        {{-- KOLOM 3: STATUS BADGE --}}
                        <td class="p-4">
                            @if($b->status == 'pending')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    Menunggu Cek
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    {{ ucfirst($b->status) }}
                                </span>
                            @endif
                        </td>
                        
                        {{-- KOLOM 4: AKSI TOMBOL --}}
                        <td class="p-4 text-center pr-6">
                            @if($b->status == 'pending')
                            <form action="{{ route('admin.donasi-barang.verifikasi', $b->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="bg-emerald-800 hover:bg-emerald-700 text-white font-bold px-4 py-2 rounded-xl text-xs transition shadow-sm shadow-emerald-800/10 flex items-center gap-1">
                                    ✓ Verifikasi Masuk
                                </button>
                            </form>
                            @else
                                <span class="inline-flex items-center gap-1 text-emerald-700 font-bold bg-emerald-50 px-3 py-1.5 rounded-xl border border-emerald-100">
                                    ✓ Sudah Terdata di Posko
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-12 text-center text-slate-400">
                            <span class="text-3xl block mb-2">🍃</span>
                            <p class="font-medium text-slate-500">Tidak ada pengajuan donasi barang yang tercatat.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- PAGINATION --}}
        @if($barang->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            {{ $barang->links() }}
        </div>
        @endif
    </div>
</div>
@endsection