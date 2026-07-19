@extends('layouts.admin')
@section('title', 'Kelola Transparansi')

@section('admin-content')
<div class="space-y-8 pb-12">

    @if(session('success'))
    <div class="flex items-center gap-3 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-800 text-xs font-semibold shadow-sm">
        <span>✨</span>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <div>
        <h2 class="text-xl font-bold text-slate-900 tracking-tight">📊 Kelola Transparansi Publik</h2>
        <p class="text-xs text-slate-500 mt-0.5">Pilih donasi mana saja yang ditampilkan di halaman transparansi publik.</p>
    </div>

    {{-- ================= DONASI DANA ================= --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden text-xs">
        <div class="p-4 pl-6 border-b border-slate-200 bg-slate-50">
            <h3 class="font-bold text-slate-800 text-sm">💳 Donasi Dana Terverifikasi</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-slate-50 text-slate-400 font-bold uppercase text-[10px] border-b border-slate-200">
                    <tr>
                        <th class="p-4 pl-6">Donatur / Waktu</th>
                        <th class="p-4">Program</th>
                        <th class="p-4">Nominal</th>
                        <th class="p-4 text-center pr-6">Tampil di Publik?</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-600">
                    @forelse($dana as $d)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="p-4 pl-6">
                            <div class="font-bold text-slate-900 text-sm">{{ $d->anonim ? 'Anonim' : ($d->user->name ?? 'Donatur') }}</div>
                            <div class="text-[10px] text-slate-400 mt-0.5">📅 {{ $d->created_at->format('d M Y, H:i') }} WIB</div>
                        </td>
                        <td class="p-4">{{ $d->program->judul ?? 'Program Umum' }}</td>
                        <td class="p-4 font-mono font-extrabold text-emerald-800">Rp {{ number_format($d->nominal, 0, ',', '.') }}</td>
                        <td class="p-4 text-center pr-6">
                            <form action="{{ route('admin.transparansi.toggle-dana', $d->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl text-[11px] font-bold border transition
                                    {{ $d->tampil_publik
                                        ? 'bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-100'
                                        : 'bg-slate-50 text-slate-400 border-slate-200 hover:bg-slate-100' }}">
                                    {{ $d->tampil_publik ? '👁️ Tampil' : '🙈 Disembunyikan' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="p-8 text-center text-slate-400">Belum ada donasi dana terverifikasi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($dana->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">{{ $dana->links() }}</div>
        @endif
    </div>

    {{-- ================= DONASI BARANG ================= --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden text-xs">
        <div class="p-4 pl-6 border-b border-slate-200 bg-slate-50">
            <h3 class="font-bold text-slate-800 text-sm">📦 Donasi Barang Diterima</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-slate-50 text-slate-400 font-bold uppercase text-[10px] border-b border-slate-200">
                    <tr>
                        <th class="p-4 pl-6">Pengirim / Waktu</th>
                        <th class="p-4">Program</th>
                        <th class="p-4">Rincian Barang</th>
                        <th class="p-4 text-center pr-6">Tampil di Publik?</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-600">
                    @forelse($barang as $b)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="p-4 pl-6">
                            <div class="font-bold text-slate-900 text-sm">{{ $b->nama_pengirim ?? 'Anonim' }}</div>
                            <div class="text-[10px] text-slate-400 mt-0.5">📅 {{ $b->created_at->format('d M Y, H:i') }} WIB</div>
                        </td>
                        <td class="p-4">{{ $b->programDonasi->judul ?? 'Program Umum' }}</td>
                        <td class="p-4">
                            <div class="flex flex-wrap gap-1.5 max-w-xs">
                                @forelse($b->itemBarang as $item)
                                <span class="inline-flex items-center px-2 py-1 rounded-lg bg-slate-100 font-bold text-slate-700 text-[11px]">
                                    {{ $item->nama_barang }} — {{ $item->jumlah }} {{ $item->satuan }}
                                </span>
                                @empty
                                <span class="text-[10px] text-slate-400 italic">Tidak ada rincian</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="p-4 text-center pr-6">
                            <form action="{{ route('admin.transparansi.toggle-barang', $b->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl text-[11px] font-bold border transition
                                    {{ $b->tampil_publik
                                        ? 'bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-100'
                                        : 'bg-slate-50 text-slate-400 border-slate-200 hover:bg-slate-100' }}">
                                    {{ $b->tampil_publik ? '👁️ Tampil' : '🙈 Disembunyikan' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="p-8 text-center text-slate-400">Belum ada donasi barang diterima.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($barang->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">{{ $barang->links() }}</div>
        @endif
    </div>

</div>
@endsection