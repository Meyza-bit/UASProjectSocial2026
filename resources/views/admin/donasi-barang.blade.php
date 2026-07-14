@extends('layouts.admin')
@section('title', 'Verifikasi Donasi Barang')

@section('admin-content')
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden text-xs">
    <div class="p-5 border-b border-slate-100">
        <h3 class="font-bold text-slate-800">📦 Log Masuk & Validasi Fisik Barang Logistik</h3>
    </div>
    <table class="w-full text-left border-collapse whitespace-nowrap">
        <thead class="bg-slate-50 text-slate-400 font-bold uppercase text-[10px] border-b border-slate-200">
            <tr>
                <th class="p-4 pl-6">Deskripsi Barang</th>
                <th class="p-4">Status Logistik</th>
                <th class="p-4 text-center pr-6">Aksi Tindakan</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 font-medium text-slate-600">
            @forelse($barang as $b)
            <tr>
                <td class="p-4 pl-6">
                    <div class="font-bold text-slate-900">{{ $b->nama_barang ?? 'Logistik Bantuan' }}</div>
                    <div class="text-[10px] text-slate-400">Jumlah/Kondisi: {{ $b->jumlah ?? '-' }}</div>
                </td>
                <td class="p-4">
                    <span class="px-2 py-0.5 rounded {{ $b->status == 'pending' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200' }}">
                        {{ ucfirst($b->status) }}
                    </span>
                </td>
                <td class="p-4 text-center pr-6">
                    @if($b->status == 'pending')
                    <form action="/admin/donasi-barang/{{ $b->id }}/verifikasi" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="bg-slate-900 text-white font-bold px-3 py-1.5 rounded-lg hover:bg-slate-800 transition shadow-sm">✓ Verifikasi Penerimaan</button>
                    </form>
                    @else
                        <span class="text-emerald-600 font-bold">✓ Terdata di Posko</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="p-8 text-center text-slate-400">Tidak ada pengajuan donasi barang.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t border-slate-100">
        {{ $barang->links() }}
    </div>
</div>
@endsection