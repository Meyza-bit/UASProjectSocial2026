@extends('layouts.admin')
@section('title', 'Verifikasi Donasi Dana')

@section('admin-content')
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden text-xs">
    <div class="p-5 border-b border-slate-100">
        <h3 class="font-bold text-slate-800">🛡️ Validasi Pembukuan & Bukti Transfer Uang</h3>
    </div>
    <table class="w-full text-left border-collapse whitespace-nowrap">
        <thead class="bg-slate-50 text-slate-400 font-bold uppercase text-[10px] border-b border-slate-200">
            <tr>
                <th class="p-4 pl-6">ID / Tanggal</th>
                <th class="p-4">Jumlah Dana</th>
                <th class="p-4">Status Verifikasi</th>
                <th class="p-4 text-center pr-6">Aksi Tindakan</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 font-medium text-slate-600">
            @forelse($donasi as $d)
            <tr>
                <td class="p-4 pl-6">
                    <div class="font-bold text-slate-900">#TRX-{{ $d->id }}</div>
                    <div class="text-[10px] text-slate-400">{{ $d->created_at->format('d M Y H:i') }}</div>
                </td>
                <td class="p-4 font-mono font-bold text-emerald-700">Rp {{ number_format($d->jumlah, 0, ',', '.') }}</td>
                <td class="p-4">
                    @if($d->status == 'pending')
                        <span class="bg-amber-50 text-amber-700 px-2 py-0.5 border border-amber-200 rounded">Pending</span>
                    @elseif($d->status == 'terverifikasi')
                        <span class="bg-emerald-50 text-emerald-700 px-2 py-0.5 border border-emerald-200 rounded">Terverifikasi</span>
                    @else
                        <span class="bg-rose-50 text-rose-700 px-2 py-0.5 border border-rose-200 rounded">Ditolak</span>
                    @endif
                </td>
                <td class="p-4 text-center pr-6">
                    @if($d->status == 'pending')
                    <div class="flex justify-center gap-2">
                        <form action="/admin/donasi-dana/{{ $d->id }}/verifikasi" method="POST">
                            @csrf
                            <button type="submit" class="bg-emerald-600 text-white font-bold px-2.5 py-1.5 rounded-lg hover:bg-emerald-500 transition">✓ Setujui</button>
                        </form>
                        <form action="/admin/donasi-dana/{{ $d->id }}/tolak" method="POST">
                            @csrf
                            <button type="submit" class="bg-white border border-slate-200 text-rose-600 font-bold px-2.5 py-1.5 rounded-lg hover:bg-slate-50 transition">✕ Tolak</button>
                        </form>
                    </div>
                    @else
                        <span class="text-slate-400 text-[10px]">Selesai diproses</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-8 text-center text-slate-400">Tidak ada riwayat donasi dana.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t border-slate-100">
        {{ $donasi->links() }}
    </div>
</div>
@endsection