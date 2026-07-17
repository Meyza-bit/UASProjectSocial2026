@extends('layouts.admin')
@section('title', 'Kelola Program Donasi')

@section('admin-content')
<div class="space-y-6 pb-12">

    @if(session('success'))
    <div class="flex items-center gap-3 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-800 text-xs font-semibold shadow-sm">
        <span>✨</span>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900 tracking-tight">📋 Kelola Program Donasi</h2>
            <p class="text-xs text-slate-500 mt-0.5">Tambah, ubah, atau hapus program yang tampil di halaman publik.</p>
        </div>
        <a href="{{ route('admin.program-donasi.create') }}" class="bg-emerald-800 hover:bg-emerald-700 text-white font-bold px-4 py-2.5 rounded-xl text-xs transition shadow-sm">
            + Tambah Program
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden text-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-slate-50 text-slate-400 font-bold uppercase text-[10px] border-b border-slate-200">
                    <tr>
                        <th class="p-4 pl-6">Program</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Target / Terkumpul</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-center pr-6">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-600">
                    @forelse($programs as $p)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="p-4 pl-6 flex items-center gap-3">
                            <img src="{{ $p->gambar ? (str_starts_with($p->gambar, 'http') ? $p->gambar : asset('storage/'.$p->gambar)) : 'https://images.unsplash.com/photo-1594897030264-ab7d87efc473?q=80&w=100&auto=format&fit=crop' }}"
                                 class="w-12 h-12 rounded-lg object-cover border border-slate-200">
                            <span class="font-bold text-slate-900 text-sm max-w-xs line-clamp-2">{{ $p->judul }}</span>
                        </td>
                        <td class="p-4">{{ $p->kategori }}</td>
                        <td class="p-4">
                            Rp {{ number_format($p->dana_terkumpul, 0, ',', '.') }} / Rp {{ number_format($p->target_dana, 0, ',', '.') }}
                        </td>
                        <td class="p-4">
                            @if($p->status == 'aktif')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Aktif</span>
                            @elseif($p->status == 'darurat')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-50 text-red-700 border border-red-200">Darurat</span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-500 border border-slate-200">Selesai</span>
                            @endif
                        </td>
                        <td class="p-4 text-center pr-6">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('admin.program-donasi.edit', $p->id) }}" class="bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 font-bold px-3 py-1.5 rounded-xl text-[11px] transition">
                                    ✎ Edit
                                </a>
                                <form action="{{ route('admin.program-donasi.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin hapus program ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-white border border-slate-200 text-rose-600 hover:bg-rose-50 font-bold px-3 py-1.5 rounded-xl text-[11px] transition">
                                        ✕ Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-12 text-center text-slate-400">
                            <span class="text-3xl block mb-2">📋</span>
                            <p class="font-medium text-slate-500">Belum ada program donasi.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($programs->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            {{ $programs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection