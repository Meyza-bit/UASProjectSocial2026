@extends('layouts.app')

@section('title', 'Terima Kasih - MariBerbagi')

@section('content')
<div class="max-w-xl mx-auto p-6 py-16 text-center">
    <div class="text-5xl mb-4">📦</div>

    <h1 class="text-2xl font-bold text-slate-800 mb-2">Terima Kasih, {{ $pengiriman->nama_pengirim }}!</h1>
    <p class="text-slate-600 mb-8">
        Data pengiriman barang Anda sudah kami terima. Tim logistik kami akan menghubungi Anda
        melalui WhatsApp dalam 1x24 jam untuk memandu proses pengiriman selanjutnya.
    </p>

    <div class="bg-slate-50 rounded-2xl p-6 mb-8 text-left space-y-3">
        <div class="flex justify-between text-sm">
            <span class="text-slate-500">No. Referensi</span>
            <span class="font-bold text-slate-800">#BRG-{{ str_pad($pengiriman->id, 5, '0', STR_PAD_LEFT) }}</span>
        </div>
        <div class="flex justify-between text-sm">
            <span class="text-slate-500">Tujuan Program</span>
            <span class="font-bold text-slate-800 text-right">{{ $pengiriman->programDonasi->judul ?? '-' }}</span>
        </div>
        <div class="flex justify-between text-sm">
            <span class="text-slate-500">No. Telepon</span>
            <span class="font-bold text-slate-800">{{ $pengiriman->nomor_telepon }}</span>
        </div>
        <div class="flex justify-between text-sm">
            <span class="text-slate-500">Status</span>
            @if($pengiriman->status == 'pending')
                <span class="font-bold text-amber-600">Menunggu Verifikasi Tim</span>
            @elseif($pengiriman->status == 'diterima')
                <span class="font-bold text-emerald-600">Diterima Tim Kami</span>
            @else
                <span class="font-bold text-rose-600">Ditolak</span>
            @endif
        </div>
    </div>

    <div class="bg-slate-50 rounded-2xl p-6 mb-8 text-left space-y-2">
        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Daftar Barang</p>
        @foreach($pengiriman->itemBarang as $item)
        <div class="flex justify-between text-sm">
            <span class="text-slate-700">{{ $item->nama_barang }}</span>
            <span class="font-semibold text-slate-800">{{ $item->jumlah }} {{ $item->satuan }}</span>
        </div>
        @endforeach
    </div>

    <a href="{{ route('barang.index') }}"
        class="inline-block bg-emerald-800 hover:bg-emerald-900 text-white font-bold px-8 py-3.5 rounded-xl transition shadow-md">
        Kembali ke Katalog
    </a>
</div>

@endsection