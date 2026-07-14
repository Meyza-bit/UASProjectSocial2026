@extends('layouts.admin')
@section('title', 'Manajemen User')

@section('admin-content')
<div class="space-y-6 pb-12">
    
    {{-- ALERT NOTIFIKASI SUKSES (Bila ada fitur hapus/edit kedepannya) --}}
    @if(session('success'))
    <div class="flex items-center gap-3 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-800 text-xs font-semibold shadow-sm animate-fade-in">
        <span>✨</span>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    {{-- HEADER MANAJEMEN USER --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900 tracking-tight">👥 Manajemen Pengguna & Donatur</h2>
            <p class="text-xs text-slate-500 mt-0.5">Pantau seluruh akun terregistrasi, hak akses sistem, serta daftar donatur aktif platform.</p>
        </div>
        <div class="px-3 py-1.5 bg-white border border-slate-200 rounded-xl text-[11px] font-bold text-slate-600 shadow-sm">
            Total Pengguna: <span class="text-emerald-700 font-extrabold">{{ $users->total() }}</span>
        </div>
    </div>

    {{-- TABLE CONTAINER --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden text-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-slate-50 text-slate-400 font-bold uppercase text-[10px] border-b border-slate-200">
                    <tr>
                        <th class="p-4 pl-6">Nama Akun</th>
                        <th class="p-4">Kontak Email</th>
                        <th class="p-4 pr-6">Hak Akses / Peran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-600">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        {{-- KOLOM 1: NAMA AKUN DENGAN INITIAL AVATAR --}}
                        <td class="p-4 pl-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-xl bg-emerald-50 border border-emerald-100/80 flex items-center justify-center font-bold text-emerald-800 text-xs shadow-sm">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900 text-sm">{{ $user->name }}</div>
                                    <div class="text-[9px] text-slate-400 mt-0.5">Terdaftar: {{ $user->created_at ? $user->created_at->format('d M Y') : 'Baru' }}</div>
                                </div>
                            </div>
                        </td>
                        
                        {{-- KOLOM 2: CONTACT EMAIL --}}
                        <td class="p-4 font-mono text-slate-500 text-[11px]">
                            {{ $user->email }}
                        </td>
                        
                        {{-- KOLOM 3: BADGE HAK AKSES --}}
                        <td class="p-4 pr-6">
                            @if(($user->role ?? 'user') == 'admin')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-800 text-emerald-50 shadow-sm shadow-emerald-800/10">
                                    👑 ADMIN
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200/60">
                                    👤 DONATUR
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="p-12 text-center text-slate-400">
                            <span class="text-3xl block mb-2">🍃</span>
                            <p class="font-medium text-slate-500">Tidak ada pengguna terdaftar di basis data.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- PAGINATION --}}
        @if($users->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>
@endsection