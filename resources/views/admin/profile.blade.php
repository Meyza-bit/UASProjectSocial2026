@extends('layouts.admin')
@section('title', 'Profil Admin')

@section('admin-content')
<div class="space-y-6 pb-12">

    {{-- ALERT NOTIFIKASI SUKSES --}}
    @if(session('success'))
    <div class="flex items-center gap-3 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-800 text-xs font-semibold shadow-sm animate-fade-in">
        <span>✨</span>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    {{-- ALERT NOTIFIKASI ERROR VALIDASI --}}
    @if($errors->any())
    <div class="flex items-start gap-3 p-4 rounded-2xl bg-rose-50 border border-rose-100 text-rose-700 text-xs font-semibold shadow-sm">
        <span>⚠️</span>
        <ul class="space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- HEADER PROFIL --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900 tracking-tight">🛡️ Profil Administrator</h2>
            <p class="text-xs text-slate-500 mt-0.5">Kelola informasi akun dan keamanan login panel admin kamu.</p>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">

        {{-- KARTU IDENTITAS ADMIN --}}
        <div class="lg:col-span-1 bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 text-center h-fit">
            <div class="w-20 h-20 mx-auto rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center font-extrabold text-emerald-800 text-2xl shadow-sm">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <h3 class="font-bold text-slate-900 text-base mt-4">{{ $user->name }}</h3>
            <p class="text-[11px] text-slate-400 font-mono mt-0.5">{{ $user->email }}</p>

            <div class="mt-4">
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-800 text-emerald-50 shadow-sm shadow-emerald-800/10">
                    👑 ADMIN
                </span>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100 text-left space-y-2">
                <div class="flex justify-between text-[11px]">
                    <span class="text-slate-400 font-semibold">Bergabung Sejak</span>
                    <span class="text-slate-700 font-bold">{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</span>
                </div>
            </div>
        </div>

        {{-- FORM EDIT PROFIL --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 space-y-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">✏️ Ubah Informasi Akun</h4>
            </div>

            <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-600/30 focus:border-emerald-600 transition">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1.5">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-600/30 focus:border-emerald-600 transition">
                </div>

                <div class="pt-2">
                    <button type="submit" class="bg-emerald-800 hover:bg-emerald-700 text-white font-bold px-5 py-2.5 rounded-xl text-xs transition shadow-sm shadow-emerald-800/10">
                        💾 Simpan Perubahan
                    </button>
                </div>
            </form>

            {{-- FORM GANTI PASSWORD --}}
            <div class="pt-4 border-t border-slate-100">
                <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-4">🔒 Ganti Password</h4>

                <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-[11px] font-bold text-slate-600 mb-1.5">Password Saat Ini</label>
                        <input type="password" name="current_password"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-600/30 focus:border-emerald-600 transition">
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-600 mb-1.5">Password Baru</label>
                            <input type="password" name="password"
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-600/30 focus:border-emerald-600 transition">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-600 mb-1.5">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation"
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-600/30 focus:border-emerald-600 transition">
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="bg-white border border-slate-200 hover:border-emerald-600 text-emerald-800 font-bold px-5 py-2.5 rounded-xl text-xs transition shadow-sm">
                            🔑 Perbarui Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection