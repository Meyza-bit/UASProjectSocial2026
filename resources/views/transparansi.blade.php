@extends('layouts.app')

@section('title', 'Transparansi Donasi - MariBerbagi')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12">

    {{-- HEADER --}}
    <div class="text-center max-w-2xl mx-auto">
        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-100">
            ✦ Transparansi Penuh
        </span>
        <h1 class="text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight mt-4">
            Setiap Rupiah, Kami Pertanggungjawabkan
        </h1>
        <p class="text-slate-600 mt-3">
            Pantau langsung donasi yang masuk, progres setiap program, dan bukti penyaluran bantuan ke penerima.
        </p>
    </div>

    {{-- RINGKASAN STATISTIK --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-emerald-800 text-white rounded-2xl p-6 text-center shadow-md">
            <p class="text-2xl sm:text-3xl font-extrabold">Rp {{ number_format($totalDanaTerkumpul, 0, ',', '.') }}</p>
            <p class="text-xs font-medium text-emerald-100 uppercase tracking-wider mt-1">Total Dana Terkumpul</p>
        </div>
        <div class="bg-slate-900 text-white rounded-2xl p-6 text-center shadow-md">
            <p class="text-2xl sm:text-3xl font-extrabold">Rp {{ number_format($totalDanaTersalurkan, 0, ',', '.') }}</p>
            <p class="text-xs font-medium text-slate-300 uppercase tracking-wider mt-1">Total Dana Tersalurkan</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-6 text-center shadow-sm">
            <p class="text-2xl sm:text-3xl font-extrabold text-emerald-800">{{ $totalDonatur }}</p>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mt-1">Donatur Berkontribusi</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-6 text-center shadow-sm">
            <p class="text-2xl sm:text-3xl font-extrabold text-amber-600">{{ $totalDonasiBarang }}</p>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mt-1">Kiriman Barang Diterima</p>
        </div>
    </div>

    {{-- SECTION 2: DAFTAR DONASI MASUK --}}
    <section class="space-y-4">
        <h2 class="text-xl font-bold text-slate-900">💳 Donasi Masuk Terverifikasi</h2>
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden text-xs">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-400 font-bold uppercase text-[10px] border-b border-slate-200">
                        <tr>
                            <th class="p-4 pl-6">Donatur</th>
                            <th class="p-4">Program</th>
                            <th class="p-4">Nominal</th>
                            <th class="p-4">Metode</th>
                            <th class="p-4 pr-6">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-600">
                        @forelse($donasiMasuk as $d)
                        <tr>
                            <td class="p-4 pl-6 font-semibold text-slate-800">
                                {{ $d->anonim ? 'Anonim' : ($d->user->name ?? 'Donatur') }}
                            </td>
                            <td class="p-4 text-emerald-700 font-semibold">{{ $d->program->judul ?? 'Program Umum' }}</td>
                            <td class="p-4 font-bold text-emerald-800">Rp {{ number_format($d->nominal, 0, ',', '.') }}</td>
                            <td class="p-4 uppercase text-slate-500">{{ str_replace('_', ' ', $d->metode_bayar) }}</td>
                            <td class="p-4 pr-6 text-slate-400">{{ $d->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-slate-400">Belum ada donasi terverifikasi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- SECTION 2B: DAFTAR DONASI BARANG --}}
    <section class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold text-slate-900">📦 Donasi Barang Diterima</h2>
            <span class="text-xs font-bold text-slate-500 bg-slate-100 px-3 py-1.5 rounded-full">{{ $totalDonasiBarang }} Kiriman</span>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            @forelse($donasiBarang as $db)
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md transition p-5 space-y-3">
                <div class="flex items-start justify-between gap-2">
                    <div class="flex items-center gap-2.5">
                        <span class="w-9 h-9 rounded-xl bg-amber-50 flex items-center justify-center text-base shrink-0">📦</span>
                        <div>
                            <p class="font-bold text-sm text-slate-900 leading-tight">{{ $db->nama_pengirim }}</p>
                            <p class="text-[10px] text-slate-400">{{ $db->created_at->format('d M Y, H:i') }} WIB</p>
                        </div>
                    </div>
                </div>
                <p class="text-xs text-slate-500">
                    Untuk program: <span class="font-semibold text-emerald-700">{{ $db->programDonasi->judul ?? 'Program Umum' }}</span>
                </p>
                <div class="flex flex-wrap gap-1.5 pt-1 border-t border-slate-100">
                    @forelse($db->itemBarang as $item)
                    <span class="inline-flex items-center gap-1 text-[10px] font-semibold bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-lg mt-2">
                        {{ $item->nama_barang }}
                        <span class="text-emerald-500 font-bold">· {{ $item->jumlah }} {{ $item->satuan }}</span>
                    </span>
                    @empty
                    <p class="text-[10px] text-slate-400 italic mt-2">Tidak ada rincian barang tercatat.</p>
                    @endforelse
                </div>
            </div>
            @empty
            <div class="sm:col-span-2 text-center py-12 bg-white rounded-2xl border border-dashed border-slate-200">
                <span class="text-3xl block mb-2">🍃</span>
                <p class="text-slate-400 font-medium text-sm">Belum ada donasi barang yang diterima.</p>
                <p class="text-slate-300 text-xs mt-1">Kiriman barang akan muncul di sini setelah diverifikasi tim posko.</p>
            </div>
            @endforelse
        </div>
    </section>

    {{-- SECTION 3: RIWAYAT PENYALURAN (GABUNGAN DANA & BARANG) --}}
    <section class="space-y-4">
        <h2 class="text-xl font-bold text-slate-900">🚚 Riwayat Penyaluran</h2>
        <div class="space-y-4">
            @forelse($riwayatPenyaluran as $p)
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-5 flex flex-col sm:flex-row gap-4">
                @if($p->bukti_penyaluran)
                <img src="{{ asset('storage/'.$p->bukti_penyaluran) }}" class="w-full sm:w-32 h-32 object-cover rounded-xl border border-slate-200">
                @endif
                <div class="flex-1 space-y-1">
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2">
                            @if($p->tipe == 'dana')
                                <span class="text-[9px] font-bold uppercase px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700">💳 Dana</span>
                            @else
                                <span class="text-[9px] font-bold uppercase px-2 py-0.5 rounded-md bg-amber-50 text-amber-700">📦 Barang</span>
                            @endif
                            <h3 class="font-bold text-sm text-slate-900">{{ $p->program->judul ?? 'Program tidak ditemukan' }}</h3>
                        </div>
                        <span class="text-[11px] text-slate-400 shrink-0">{{ $p->tanggal_penyaluran->format('d M Y') }}</span>
                    </div>

                    @if($p->tipe == 'dana')
                        <p class="text-emerald-800 font-bold text-sm">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</p>
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $p->keterangan }}</p>
                    @else
                        <p class="text-amber-700 font-bold text-sm">{{ $p->nama_barang }} · {{ $p->jumlah }} {{ $p->satuan }}</p>
                        @if($p->penerima)
                        <p class="text-xs text-slate-600">Diserahkan kepada: <span class="font-semibold">{{ $p->penerima }}</span></p>
                        @endif
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $p->keterangan }}</p>
                    @endif
                </div>
            </div>
            @empty
            <p class="text-slate-400 text-center py-8">Belum ada riwayat penyaluran.</p>
            @endforelse
        </div>
    </section>

</div>
@endsection