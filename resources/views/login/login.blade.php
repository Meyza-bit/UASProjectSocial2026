@extends('layouts.app')

@section('title', 'Masuk ke Akun Anda — Mari Berbagi')

@section('content')
<div class="min-h-[80vh] flex flex-col justify-center items-center px-4 bg-slate-50">
    <div class="w-full max-w-md bg-white border border-slate-200/80 rounded-3xl p-8 shadow-sm space-y-6">
        
        {{-- Header Form --}}
        <div class="text-center space-y-2">
            <span class="text-3xl">👋</span>
            <h1 class="text-xl font-extrabold text-slate-900 tracking-tight">Selamat Datang Kembali</h1>
            <p class="text-xs text-slate-500">Silakan masuk untuk melanjutkan aksi baikmu di MariBerbagi.</p>
        </div>

        {{-- Notifikasi Error (Frontend Handler) --}}
        @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded-xl text-xs font-semibold">
            @foreach ($errors->all() as $error)
                <p>⚠️ {{ $error }}</p>
            @endforeach
        </div>
        @endif

        {{-- Form Login --}}
        <form action="{{ route('login') }}" method="POST" class="space-y-4 text-xs font-medium">
            @csrf
            
            {{-- Input Email --}}
            <div class="space-y-1.5">
                <label for="email" class="text-slate-600 font-bold">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-700 bg-slate-50/50 text-slate-800 transition" 
                    placeholder="nama@mahasiswa.id">
            </div>

            {{-- Input Password --}}
            <div class="space-y-1.5">
                <div class="flex justify-between items-center">
                    <label for="password" class="text-slate-600 font-bold">Kata Sandi</label>
                    <a href="#" class="text-[11px] font-bold text-emerald-800 hover:underline">Lupa password?</a>
                </div>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-700 bg-slate-50/50 text-slate-800 transition" 
                    placeholder="••••••••">
            </div>

            {{-- Tombol Submit --}}
            <button type="submit" 
                class="w-full bg-emerald-800 hover:bg-emerald-700 text-white font-bold py-3.5 rounded-xl transition shadow-sm text-center tracking-wide mt-2">
                Masuk Sekarang
            </button>
        </form>

        {{-- Footer Form --}}
        <div class="text-center text-[11px] text-slate-500 font-medium pt-2 border-t border-slate-100">
            Belum punya akun? <a href="{{ route('register') }}" class="text-emerald-800 font-bold hover:underline">Daftar disini</a>
        </div>

    </div>
</div>
@endsection