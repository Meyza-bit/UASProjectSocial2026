@extends('layouts.admin')
@section('title', 'Moderasi Umpan Balik')

@section('admin-content')
<div class="space-y-6 pb-12">
    
    {{-- ALERT NOTIFIKASI SUKSES --}}
    @if(session('success'))
    <div class="flex items-center gap-3 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-800 text-xs font-semibold shadow-sm animate-fade-in">
        <span>✨</span>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    {{-- HEADER MODERASI FEEDBACK --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900 tracking-tight">💬 Pengawasan Umpan Balik Publik</h2>
            <p class="text-xs text-slate-500 mt-0.5">Moderasi pesan masuk dari masyarakat untuk menyaring spam, ujaran kebencian, atau komentar negatif.</p>
        </div>
        <div class="px-3 py-1.5 bg-white border border-slate-200 rounded-xl text-[11px] font-bold text-slate-600 shadow-sm">
            Total Umpan Balik: <span class="text-emerald-700 font-extrabold">{{ $feedbacks->total() }}</span>
        </div>
    </div>

    {{-- TABLE CONTAINER --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden text-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-slate-400 font-bold uppercase text-[10px] border-b border-slate-200">
                    <tr>
                        <th class="p-4 pl-6 w-1/4 whitespace-nowrap">Pengirim</th>
                        <th class="p-4 w-1/2">Isi Komentar / Umpan Balik</th>
                        <th class="p-4 text-center pr-6 w-1/4 whitespace-nowrap">Tindakan Moderasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-600">
                    @forelse($feedbacks as $fb)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        {{-- KOLOM 1: IDENTITAS PENGIRIM --}}
                        <td class="p-4 pl-6 align-top">
                            <div class="font-bold text-slate-900 text-sm flex items-center gap-1.5 whitespace-nowrap">
                                <span class="text-base">👤</span>
                                {{ $fb->nama ?? 'Anonim' }}
                            </div>
                            @if(isset($fb->email))
                            <div class="text-[10px] text-slate-400 mt-0.5 font-mono whitespace-nowrap">
                                {{ $fb->email }}
                            </div>
                            @endif
                            @if(isset($fb->created_at))
                            <div class="text-[9px] text-slate-400 mt-1 whitespace-nowrap">
                                📅 {{ $fb->created_at->format('d M Y, H:i') }}
                            </div>
                            @endif
                        </td>
                        
                        {{-- KOLOM 2: ISI KOMENTAR --}}
                        <td class="p-4 text-slate-600 min-w-[300px]">
                            <div class="bg-slate-50/80 rounded-xl p-3 border border-slate-100 text-[11px] leading-relaxed">
                                {{ $fb->komentar }}
                            </div>
                        </td>
                        
                        {{-- KOLOM 3: TOMBOL HAPUS SPAM --}}
                        <td class="p-4 text-center pr-6 align-middle">
                            <form action="/admin/feedback/{{ $fb->id }}/hapus" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus umpan balik ini? Tindakan ini tidak dapat dibatalkan.')" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1.5 bg-white hover:bg-rose-50 border border-slate-200 hover:border-rose-200 text-rose-600 hover:text-rose-700 font-bold px-3 py-2 rounded-xl transition shadow-sm text-[11px] whitespace-nowrap">
                                    <span>🗑️</span> Hapus Komentar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="p-12 text-center text-slate-400">
                            <span class="text-3xl block mb-2">🍃</span>
                            <p class="font-medium text-slate-500">Kolom umpan balik bersih, belum ada komentar masuk dari publik.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- PAGINATION --}}
        @if($feedbacks->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            {{ $feedbacks->links() }}
        </div>
        @endif
    </div>
</div>
@endsection