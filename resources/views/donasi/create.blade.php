@extends('layouts.app')

@section('title', 'Donasi Dana - MariBerbagi')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-12">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-emerald-950 tracking-tight">Donasi Dana</h1>
        <p class="text-slate-600 mt-2">Salurkan bantuan dana Anda secara amanah untuk mereka yang membutuhkan.</p>
    </div>

    {{-- Form Container --}}
    <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
        {{-- Ganti action="#" menjadi route('donasi.store') --}}
        <form action="{{ route('donasi.store') }}" method="POST" class="space-y-6">
            @csrf
        {{-- ... sisa kode inputanmu tetap sama ... --}}
            
            {{-- Input Nama --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" id="name" name="name" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 transition outline-none">
            </div>

            {{-- Input Nominal --}}
            <div>
                <label for="amount" class="block text-sm font-semibold text-slate-700 mb-2">Nominal Donasi (Rp)</label>
                <input type="number" id="amount" name="amount" placeholder="Contoh: 50000" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 transition outline-none">
            </div>

            {{-- Input Pesan --}}
            <div>
                <label for="message" class="block text-sm font-semibold text-slate-700 mb-2">Pesan/Doa (Opsional)</label>
                <textarea id="message" name="message" rows="4"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 transition outline-none"></textarea>
            </div>

            {{-- Submit Button --}}
            <button type="submit" 
                class="w-full bg-emerald-800 hover:bg-emerald-900 text-white font-bold py-3.5 rounded-xl transition shadow-md">
                Lanjut ke Pembayaran
            </button>
        </form>
    </div>
</div>
@endsection