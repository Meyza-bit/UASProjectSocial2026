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
            <span class="font-bold text-slate-800 text-right">{{ $pengiriman->program }}</span>
        </div>
        <div class="flex justify-between text-sm">
            <span class="text-slate-500">Ekspedisi</span>
            <span class="font-bold text-slate-800">{{ $pengiriman->ekspedisi }}</span>
        </div>
        <div class="flex justify-between text-sm">
            <span class="text-slate-500">Status</span>
            <span class="font-bold text-amber-600">Menunggu Verifikasi Tim</span>
        </div>
    </div>

    @if($pengiriman->ekspedisi === 'Antar Langsung')
    <div class="p-4 bg-emerald-50 border border-emerald-100 rounded-xl text-sm text-emerald-800 mb-8 text-left">
        ✦ Karena Anda memilih <strong>Antar Langsung</strong>, mohon tunggu konfirmasi alamat penjemputan
        dari tim kami via WhatsApp ke nomor {{ $pengiriman->hp_pengirim }}.
    </div>
    @endif

    <a href="{{ route('barang.index') }}"
        class="inline-block bg-emerald-800 hover:bg-emerald-900 text-white font-bold px-8 py-3.5 rounded-xl transition shadow-md">
        Kembali ke Katalog
    </a>
</div>
@endsection