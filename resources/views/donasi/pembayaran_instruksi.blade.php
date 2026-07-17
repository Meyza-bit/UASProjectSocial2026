@extends('layouts.app')

@section('title', 'Instruksi Pembayaran - MariBerbagi')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <!-- Status & Header -->
    <div class="text-center mb-8">
        <span class="bg-emerald-100 text-emerald-800 px-4 py-1 rounded-full font-semibold text-sm">
            Menunggu Pembayaran
        </span>
        <h1 class="text-2xl font-bold text-slate-800 mt-4">Selesaikan Pembayaran</h1>
        <p class="text-slate-600">Terima kasih, {{ $donasi->user->name ?? 'Donatur' }}. Mohon transfer dana Anda sebelum 24 jam.</p>
    </div>

    <!-- Ringkasan Nominal (FIX: ambil dari $donasi->amount, bukan hardcode) -->
    <div class="bg-slate-50 p-6 rounded-xl text-center mb-6">
        <p class="text-sm text-slate-500">Total yang harus dibayar</p>
        <h2 class="text-3xl font-bold text-emerald-900 mt-1">
            Rp {{ number_format($donasi->nominal, 0, ',', '.') }}
        </h2>
    </div>

    <!-- Tujuan Pembayaran (FIX: dinamis sesuai metode yang dipilih, dikirim controller via $info) -->
    <div class="border-2 border-dashed border-slate-300 p-6 rounded-xl mb-6">
        <p class="font-bold text-slate-700 mb-2">
            {{ $info['label'] }} ({{ $donasi->metode_bayar }})
        </p>
        <p class="text-2xl font-mono font-bold tracking-widest text-slate-900">
            {{ $info['tujuan'] }}
        </p>
    </div>

    <!-- Cara Pembayaran (teksnya disesuaikan tipe metode: bank atau e-wallet) -->
    <div class="mb-8">
        <h3 class="font-bold text-slate-800 mb-3">Cara Pembayaran:</h3>
        @if($info['tipe'] === 'bank')
            <ul class="list-decimal list-inside text-slate-600 space-y-2 text-sm">
                <li>Buka aplikasi Mobile Banking Anda.</li>
                <li>Pilih menu Transfer Antar Bank.</li>
                <li>Masukkan nomor rekening di atas.</li>
                <li>Pastikan nominal transfer sesuai.</li>
            </ul>
        @else
            <ul class="list-decimal list-inside text-slate-600 space-y-2 text-sm">
                <li>Buka aplikasi {{ $donasi->metode_bayar }} Anda.</li>
                <li>Pilih menu Transfer/Kirim Dana.</li>
                <li>Masukkan nomor tujuan di atas.</li>
                <li>Pastikan nominal transfer sesuai.</li>
            </ul>
        @endif
    </div>

    <!-- Form Upload Bukti Transfer -->
    <!-- enctype="multipart/form-data" WAJIB ada, kalau tidak ada file tidak akan terkirim -->
    <form action="{{ route('donasi.selesai') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label for="bukti" class="block text-sm font-semibold text-slate-700 mb-2">
                Upload Bukti Transfer
            </label>
            <input type="file" id="bukti" name="bukti" accept=".jpg,.jpeg,.png,.pdf" required
                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 transition outline-none">
            <p class="text-xs text-slate-500 mt-1">Format JPG, PNG, atau PDF. Maksimal 2MB.</p>

            {{-- Tampilkan pesan error validasi kalau ada (misal file kosong/terlalu besar) --}}
            @error('bukti')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="block w-full text-center bg-emerald-800 text-white font-bold py-4 rounded-xl hover:bg-emerald-900 transition">
            Kirim Bukti Pembayaran
        </button>
    </form>
</div>
@endsection