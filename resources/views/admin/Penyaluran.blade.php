@extends('layouts.admin')
@section('title', 'Kelola Penyaluran')

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
        <h2 class="text-xl font-bold text-slate-900 tracking-tight">🚚 Kelola Penyaluran Bantuan</h2>
        <p class="text-xs text-slate-500 mt-0.5">Catat dana maupun barang yang disalurkan ke program/penerima, dari satu tempat.</p>
    </div>

    {{-- DUA FORM BERSEBELAHAN --}}
    <div class="grid lg:grid-cols-2 gap-6">

        {{-- FORM PENYALURAN DANA --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6">
            <h3 class="text-sm font-bold text-slate-800 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                💳 Tambah Penyaluran Dana
            </h3>
            <form action="{{ route('admin.penyaluran-dana.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <div class="flex flex-col space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Program Tujuan</label>
                    <select name="id_program" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-600 focus:bg-white transition">
                        <option value="">-- Umum --</option>
                        @foreach($programs as $p)
                        <option value="{{ $p->id }}">{{ $p->judul }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Jumlah (Rp)</label>
                    <input type="number" name="jumlah" min="1000" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-600 focus:bg-white transition" placeholder="5000000" required>
                </div>
                <div class="flex flex-col space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Tanggal</label>
                    <input type="date" name="tanggal_penyaluran" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-600 focus:bg-white transition" required>
                </div>
                <div class="flex flex-col space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Bukti Foto (opsional)</label>
                    <input type="file" name="bukti_penyaluran" accept="image/*" class="w-full text-xs bg-slate-50/50 border border-slate-200 rounded-xl px-3 py-2 focus:outline-none focus:border-emerald-600 transition">
                </div>
                <div class="flex flex-col space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Keterangan</label>
                    <textarea name="keterangan" rows="2" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-600 focus:bg-white transition" placeholder="Opsional"></textarea>
                </div>
                <button type="submit" class="w-full bg-emerald-800 hover:bg-emerald-700 text-white font-bold px-5 py-2.5 rounded-xl text-xs transition shadow-sm">
                    💾 Simpan Penyaluran Dana
                </button>
            </form>
        </div>

        {{-- FORM PENYALURAN BARANG --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6">
            <h3 class="text-sm font-bold text-slate-800 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                📦 Tambah Penyaluran Barang
            </h3>
            <form action="{{ route('admin.penyaluran-barang.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <div class="flex flex-col space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Program Tujuan</label>
                    <select name="id_program" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-600 focus:bg-white transition">
                        <option value="">-- Umum --</option>
                        @foreach($programs as $p)
                        <option value="{{ $p->id }}">{{ $p->judul }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="flex flex-col space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Nama Barang</label>
                        <input type="text" name="nama_barang" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-600 focus:bg-white transition" placeholder="Beras" required>
                    </div>
                    <div class="flex flex-col space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Jumlah</label>
                        <input type="number" name="jumlah" min="1" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-600 focus:bg-white transition" placeholder="50" required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="flex flex-col space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Satuan</label>
                        <select name="satuan" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-600 focus:bg-white transition" required>
                            <option value="kg">kg</option>
                            <option value="dus">dus</option>
                            <option value="pcs">pcs</option>
                            <option value="karung">karung</option>
                        </select>
                    </div>
                    <div class="flex flex-col space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Tanggal</label>
                        <input type="date" name="tanggal_penyaluran" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-600 focus:bg-white transition" required>
                    </div>
                </div>
                <div class="flex flex-col space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Penerima</label>
                    <input type="text" name="penerima" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-600 focus:bg-white transition" placeholder="15 KK Kebakaran Siantan">
                </div>
                <div class="flex flex-col space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Bukti Foto (opsional)</label>
                    <input type="file" name="bukti_penyaluran" accept="image/*" class="w-full text-xs bg-slate-50/50 border border-slate-200 rounded-xl px-3 py-2 focus:outline-none focus:border-emerald-600 transition">
                </div>
                <div class="flex flex-col space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Keterangan</label>
                    <textarea name="keterangan" rows="2" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-600 focus:bg-white transition" placeholder="Opsional"></textarea>
                </div>
                <button type="submit" class="w-full bg-emerald-800 hover:bg-emerald-700 text-white font-bold px-5 py-2.5 rounded-xl text-xs transition shadow-sm">
                    💾 Simpan Penyaluran Barang
                </button>
            </form>
        </div>
    </div>

    {{-- TABEL RIWAYAT GABUNGAN --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden text-xs">
        <div class="p-4 pl-6 border-b border-slate-200 bg-slate-50">
            <h3 class="font-bold text-slate-800 text-sm">📋 Riwayat Penyaluran (Semua Jenis)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-slate-50 text-slate-400 font-bold uppercase text-[10px] border-b border-slate-200">
                    <tr>
                        <th class="p-4 pl-6">Jenis</th>
                        <th class="p-4">Program / Tanggal</th>
                        <th class="p-4">Detail</th>
                        <th class="p-4">Keterangan</th>
                        <th class="p-4">Bukti</th>
                        <th class="p-4 text-center pr-6">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-600">
                    @forelse($riwayat as $r)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="p-4 pl-6">
                            @if($r['jenis'] === 'dana')
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">💳 Dana</span>
                            @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">📦 Barang</span>
                            @endif
                        </td>
                        <td class="p-4">
                            <div class="font-bold text-slate-900 text-sm">{{ $r['program'] }}</div>
                            <div class="text-[10px] text-slate-400 mt-0.5">📅 {{ $r['tanggal']->format('d M Y') }}</div>
                        </td>
                        <td class="p-4 font-bold text-slate-800">{{ $r['detail'] }}</td>
                        <td class="p-4 max-w-xs whitespace-normal text-slate-500">{{ $r['keterangan'] ?: '-' }}</td>
                        <td class="p-4">
                            @if($r['bukti'])
                            <a href="{{ asset('storage/'.$r['bukti']) }}" target="_blank" class="text-emerald-700 underline font-semibold">📎 Lihat</a>
                            @else
                            <span class="text-slate-400">-</span>
                            @endif
                        </td>
                        <td class="p-4 text-center pr-6">
                            <form action="{{ $r['hapus_route'] }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:bg-rose-50 font-bold px-3 py-1.5 rounded-xl border border-slate-200 hover:border-rose-200 transition">
                                    🗑️
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="p-8 text-center text-slate-400">Belum ada data penyaluran.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection