@extends('layouts.app')

@section('title', 'Terima Kasih - MariBerbagi')

@section('content')
<div class="max-w-xl mx-auto p-6 text-center">
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-10">
        <div class="text-5xl mb-4">🙏</div>

        <h1 class="text-2xl font-bold text-slate-800">Terima Kasih, {{ $donasi->user->name ?? 'Donatur' }}!</h1>
        <p class="text-slate-600 mt-2">
            Bukti pembayaran Anda sudah kami terima dan sedang diverifikasi oleh tim kami.
        </p>

        <div class="bg-slate-50 rounded-xl p-6 mt-6 text-left space-y-2">
            <div class="flex justify-between text-sm">
                <span class="text-slate-500">Nominal Donasi</span>
                <span class="font-semibold text-slate-800">Rp {{ number_format($donasi->nominal, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-slate-500">Metode Pembayaran</span>
                <span class="font-semibold text-slate-800">{{ $donasi->metode_bayar }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-slate-500">Status</span>
                @if($donasi->status == 'pending')
                    <span class="font-semibold text-amber-600">Menunggu Verifikasi</span>
                @elseif($donasi->status == 'verified')
                    <span class="font-semibold text-emerald-600">Terverifikasi</span>
                @else
                    <span class="font-semibold text-rose-600">Ditolak</span>
                @endif
            </div>
        </div>

        <p class="text-slate-500 text-sm mt-6">
            Proses verifikasi biasanya memakan waktu 1-24 jam. Kami akan memberi tahu Anda setelah donasi terkonfirmasi.
        </p>

        <a href="{{ route('donasi.create') }}"
            class="inline-block mt-8 bg-emerald-800 hover:bg-emerald-900 text-white font-bold px-8 py-3 rounded-xl transition">
            Kembali ke Halaman Donasi
        </a>
    </div>
</div>
@endsection