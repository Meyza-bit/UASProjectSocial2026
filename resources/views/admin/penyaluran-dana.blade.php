@extends('layouts.admin')
@section('title', 'Kelola Penyaluran Dana')

@section('admin-content')
<div class="space-y-8 pb-12">

    @if(session('success'))
    <div class="flex items-center gap-3 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-800 text-xs font-semibold shadow-sm">
        <span>✨</span>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    @if($errors->any())
    <div class="p-4 rounded-2xl bg-rose-50 border border-rose-100 text-rose-700 text-xs font-semibold shadow-sm space-y-1">
        @foreach($errors->all() as $error)
        <p>⚠️ {{ $error }}</p>
        @endforeach
    </div>
    @endif

    <div>
        <h2 class="text-xl font-bold text-slate-900 tracking-tight">🚚 Kelola Penyaluran Dana</h2>
        <p class="text-xs text-slate-500 mt-0.5">Catat setiap kali dana disalurkan ke program/penerima, lengkap dengan bukti fotonya.</p>
    </div>

    {{-- FORM TAMBAH PENYALURAN --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6">
        <h3 class="text-sm font-bold text-slate-800 border-b border-slate-100 pb-3 mb-4">+ Tambah Data Penyaluran</h3>
        <form action="{{ route('admin.penyaluran-dana.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="grid sm:grid-cols-2 gap-4">
                <div class="flex flex-col space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Program Tujuan</label>
                    <select name="id_program" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-800 focus:outline-none focus:border-emerald-600 focus:bg-white transition">
                        <option value="">-- Umum / Tidak terikat program --</option>
                        @foreach($programs as $p)
                        <option value="{{ $p->id }}" {{ old('id_program') == $p->id ? 'selected' : '' }}>{{ $p->judul }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Jumlah Disalurkan (Rp)</label>
                    <input type="number" name="jumlah" value="{{ old('jumlah') }}" min="1000" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-800 focus:outline-none focus:border-emerald-600 focus:bg-white transition" placeholder="5000000" required>
                </div>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                <div class="flex flex-col space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Tanggal Penyaluran</label>
                    <input type="date" name="tanggal_penyaluran" value="{{ old('tanggal_penyaluran') }}" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-800 focus:outline-none focus:border-emerald-600 focus:bg-white transition" required>
                </div>
                <div class="flex flex-col space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Bukti Foto Penyaluran (opsional)</label>
                    <input type="file" name="bukti_penyaluran" accept="image/*" class="w-full text-xs bg-slate-50/50 border border-slate-200 rounded-xl px-3 py-2 text-slate-800 focus:outline-none focus:border-emerald-600 transition">
                </div>
            </div>
            <div class="flex flex-col space-y-1.5">
                <label class="text-xs font-semibold text-slate-700">Keterangan</label>
                <textarea name="keterangan" rows="2" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-800 focus:outline-none focus:border-emerald-600 focus:bg-white transition" placeholder="Contoh: Disalurkan berupa sembako untuk 15 KK terdampak kebakaran.">{{ old('keterangan') }}</textarea>
            </div>
            <button type="submit" class="bg-emerald-800 hover:bg-emerald-700 text-white font-bold px-5 py-2.5 rounded-xl text-xs transition shadow-sm shadow-emerald-800/10">
                💾 Simpan Penyaluran
            </button>
        </form>
    </div>

    {{-- DAFTAR RIWAYAT --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden text-xs">
        <div class="p-4 pl-6 border-b border-slate-200 bg-slate-50">
            <h3 class="font-bold text-slate-800 text-sm">📋 Riwayat Penyaluran Tercatat</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-slate-50 text-slate-400 font-bold uppercase text-[10px] border-b border-slate-200">
                    <tr>
                        <th class="p-4 pl-6">Program / Tanggal</th>
                        <th class="p-4">Jumlah</th>
                        <th class="p-4">Keterangan</th>
                        <th class="p-4">Bukti</th>
                        <th class="p-4 text-center pr-6">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-600">
                    @forelse($penyaluran as $p)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="p-4 pl-6">
                            <div class="font-bold text-slate-900 text-sm">{{ $p->program->judul ?? 'Umum' }}</div>
                            <div class="text-[10px] text-slate-400 mt-0.5">📅 {{ $p->tanggal_penyaluran->format('d M Y') }}</div>
                        </td>
                        <td class="p-4 font-mono font-extrabold text-emerald-800">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                        <td class="p-4 max-w-xs whitespace-normal text-slate-500">{{ $p->keterangan ?: '-' }}</td>
                        <td class="p-4">
                            @if($p->bukti_penyaluran)
                            <a href="{{ asset('storage/'.$p->bukti_penyaluran) }}" target="_blank" class="text-emerald-700 underline font-semibold">📎 Lihat</a>
                            @else
                            <span class="text-slate-400">-</span>
                            @endif
                        </td>
                        <td class="p-4 text-center pr-6">
                            <form action="{{ route('admin.penyaluran-dana.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:bg-rose-50 font-bold px-3 py-1.5 rounded-xl border border-slate-200 hover:border-rose-200 transition">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="p-8 text-center text-slate-400">Belum ada data penyaluran dana.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($penyaluran->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">{{ $penyaluran->links() }}</div>
        @endif
    </div>

</div>
@endsection