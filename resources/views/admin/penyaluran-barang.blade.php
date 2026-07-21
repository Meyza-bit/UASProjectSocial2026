@extends('layouts.admin')

@section('title', 'Penyaluran Barang')

@section('admin-content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900">📦 Penyaluran Barang</h1>
        <p class="text-slate-500 mt-1">Catat barang yang sudah disalurkan ke penerima bantuan.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-800 text-sm font-semibold rounded-2xl">
            ✨ {{ session('success') }}
        </div>
    @endif

    <div class="grid lg:grid-cols-3 gap-8">
        {{-- FORM TAMBAH PENYALURAN --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6 sticky top-6">
                <h2 class="font-bold text-slate-900 mb-4">Tambah Data Penyaluran</h2>

                <form action="{{ route('admin.penyaluran-barang.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Program (opsional)</label>
                        <select name="id_program" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 outline-none">
                            <option value="">-- Umum / Tidak terikat program --</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}" {{ old('id_program') == $program->id ? 'selected' : '' }}>
                                    {{ $program->judul }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_program') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Barang</label>
                        <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" required
                            placeholder="Contoh: Selimut, Beras, Air mineral"
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 outline-none">
                        @error('nama_barang') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Jumlah</label>
                            <input type="number" name="jumlah" value="{{ old('jumlah') }}" required min="1"
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 outline-none">
                            @error('jumlah') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Satuan</label>
                            <input type="text" name="satuan" value="{{ old('satuan') }}" required
                                placeholder="pcs, kg, dus"
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 outline-none">
                            @error('satuan') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Penerima (opsional)</label>
                        <input type="text" name="penerima" value="{{ old('penerima') }}"
                            placeholder="Contoh: Posko Siantan Hulu"
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 outline-none">
                        @error('penerima') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Penyaluran</label>
                        <input type="date" name="tanggal_penyaluran" value="{{ old('tanggal_penyaluran') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 outline-none">
                        @error('tanggal_penyaluran') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Keterangan (opsional)</label>
                        <textarea name="keterangan" rows="3"
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 outline-none">{{ old('keterangan') }}</textarea>
                        @error('keterangan') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Bukti Penyaluran (opsional)</label>
                        <input type="file" name="bukti_penyaluran" accept=".jpg,.jpeg,.png"
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 outline-none">
                        <p class="text-xs text-slate-500 mt-1">Format JPG/PNG, maksimal 2MB.</p>
                        @error('bukti_penyaluran') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full bg-emerald-800 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl transition">
                        Simpan Data
                    </button>
                </form>
            </div>
        </div>

        {{-- DAFTAR RIWAYAT PENYALURAN --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h2 class="font-bold text-slate-900">Riwayat Penyaluran Barang</h2>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse($penyaluran as $item)
                        <div class="p-6 flex items-start justify-between gap-4">
                            <div class="flex-1 space-y-1">
                                <p class="font-bold text-slate-900">
                                    {{ $item->nama_barang }} — {{ $item->jumlah }} {{ $item->satuan }}
                                </p>
                                <p class="text-xs text-slate-500">
                                    {{ $item->tanggal_penyaluran->format('d M Y') }}
                                    @if($item->program)
                                        · Program: {{ $item->program->judul }}
                                    @endif
                                    @if($item->penerima)
                                        · Penerima: {{ $item->penerima }}
                                    @endif
                                </p>
                                @if($item->keterangan)
                                    <p class="text-sm text-slate-600 mt-1">{{ $item->keterangan }}</p>
                                @endif
                                @if($item->bukti_penyaluran)
                                    <a href="{{ Storage::url($item->bukti_penyaluran) }}" target="_blank" class="inline-block text-xs font-semibold text-emerald-700 hover:text-emerald-900 mt-1">
                                        📎 Lihat Bukti Penyaluran
                                    </a>
                                @endif
                            </div>

                            <form action="{{ route('admin.penyaluran-barang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data penyaluran ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-bold text-rose-600 hover:text-rose-800 px-3 py-1.5 rounded-lg hover:bg-rose-50 transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="text-center text-slate-400 py-12">Belum ada data penyaluran barang.</p>
                    @endforelse
                </div>

                @if($penyaluran->hasPages())
                    <div class="p-6 border-t border-slate-100">
                        {{ $penyaluran->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection