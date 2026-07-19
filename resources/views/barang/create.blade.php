@extends('layouts.app')

@section('title', 'Kirim Barang — Mari Berbagi')

@section('content')
    <div class="bg-slate-50/50 min-h-screen py-12 lg:py-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6">
            
            {{-- FORM HEADER --}}
            <div class="text-center mb-10 space-y-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-100">
                    📦 Formulir Logistik
                </span>
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">Formulir Pengiriman Barang</h1>
                <p class="text-xs sm:text-sm text-slate-500">Input rincian logistik bantuan non-tunai Anda di bawah ini</p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-semibold">
                    ✦ {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('barang.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- PROGRAM TUJUAN --}}
                <div class="bg-white rounded-2xl border border-slate-200/60 p-6 shadow-sm space-y-4">
                    <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-2">🎯 Program Tujuan</h3>

                    @if($selectedProgram)
                    <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-4 flex items-center gap-3">
                        <span class="text-xl">🎯</span>
                        <div>
                            <p class="text-xs text-emerald-700 font-semibold">Barang ini akan dikirim untuk program:</p>
                            <p class="text-sm font-bold text-emerald-900">{{ $selectedProgram->judul }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="flex flex-col space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">
                            {{ $selectedProgram ? 'Ganti Program (opsional)' : 'Pilih Program yang Ingin Dibantu' }}
                        </label>
                        <select name="program_donasi_id" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:outline-none focus:border-emerald-600 focus:bg-white transition" required>
                            <option value="">-- Pilih Program --</option>
                            @foreach($programs as $p)
                                <option value="{{ $p->id }}" {{ (old('program_donasi_id', $selectedProgram->id ?? '')) == $p->id ? 'selected' : '' }}>
                                    {{ $p->judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- KATEGORI --}}
                <div class="bg-white rounded-2xl border border-slate-200/60 p-6 shadow-sm space-y-4">
                    <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-2">📋 Kategori Barang</h3>
                    <div class="flex flex-col space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Pilih Kategori Logistik</label>
                        <select name="kategori" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:outline-none focus:border-emerald-600 focus:bg-white transition" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Sembako"> Sembako / Bahan Pangan</option>
                            <option value="Pakaian"> Pakaian Layak Pakai</option>
                            <option value="Obat-obatan"> Obat-obatan & Medis</option>
                            <option value="Perlengkapan Bayi"> Perlengkapan Bayi & Anak</option>
                            <option value="Lainnya"> Logistik Lainnya</option>
                        </select>
                    </div>
                </div>

                {{-- LIST BARANG --}}
                <div class="bg-white rounded-2xl border border-slate-200/60 p-6 shadow-sm space-y-4">
                    <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-2">📝 Daftar Barang</h3>
                    <div id="barangList" class="space-y-3">
                        <div class="grid grid-cols-12 gap-2.5 items-center">
                            <div class="col-span-6">
                                <input type="text" name="barang[0][nama]" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:outline-none focus:border-emerald-600 focus:bg-white transition" placeholder="Contoh: Beras" required>
                            </div>
                            <div class="col-span-3">
                                <input type="number" name="barang[0][jumlah]" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:outline-none focus:border-emerald-600 focus:bg-white transition" placeholder="10" min="1" required>
                            </div>
                            <div class="col-span-2">
                                <select name="barang[0][satuan]" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-2 py-3 text-slate-800 focus:outline-none focus:border-emerald-600 focus:bg-white transition" required>
                                    <option>kg</option><option>dus</option><option>pcs</option><option>karung</option>
                                </select>
                            </div>
                            <div class="col-span-1 text-center">
                                <button type="button" class="text-slate-400 hover:text-rose-600 transition text-lg" onclick="removeRow(this)">×</button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="w-full sm:w-auto text-xs bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-4 py-2.5 rounded-xl border border-dashed border-slate-300 transition" onclick="addRow()">
                        + Tambah Barang
                    </button>
                </div>

                {{-- DATA PENGIRIM --}}
                <div class="bg-white rounded-2xl border border-slate-200/60 p-6 shadow-sm space-y-4">
                    <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-2">👤 Data Pengirim</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex flex-col space-y-1.5">
                            <label class="text-xs font-semibold text-slate-700">Nama Lengkap</label>
                            <input type="text" name="nama_pengirim" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:outline-none focus:border-emerald-600 focus:bg-white transition" placeholder="Nama lengkap pengirim" required>
                        </div>
                        <div class="flex flex-col space-y-1.5">
                            <label class="text-xs font-semibold text-slate-700">No. HP (WhatsApp)</label>
                            <input type="text" name="hp_pengirim" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:outline-none focus:border-emerald-600 focus:bg-white transition" placeholder="08xxxxxxxxxx" required>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Alamat Asal</label>
                        <textarea name="alamat_pengirim" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:outline-none focus:border-emerald-600 focus:bg-white transition" rows="3" placeholder="Alamat penjemputan / pengiriman logistik..." required></textarea>
                    </div>
                </div>

                {{-- METODE PENGIRIMAN --}}
                <div class="bg-white rounded-2xl border border-slate-200/60 p-6 shadow-sm space-y-4">
                    <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-2">🚚 Metode Pengiriman</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex flex-col space-y-1.5">
                            <label class="text-xs font-semibold text-slate-700">Ekspedisi</label>
                            <select name="ekspedisi" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:outline-none focus:border-emerald-600 focus:bg-white transition" required>
                                <option>JNE</option><option>J&T Express</option><option>SiCepat</option><option>Antar Langsung</option>
                            </select>
                        </div>
                        <div class="flex flex-col space-y-1.5">
                            <label class="text-xs font-semibold text-slate-700">Estimasi Berat Barang</label>
                            <input type="number" name="berat" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:outline-none focus:border-emerald-600 focus:bg-white transition" placeholder="kg" min="1">
                        </div>
                    </div>
                    <div class="p-4 bg-emerald-50/50 border border-emerald-100 rounded-xl text-xs font-medium text-emerald-800 leading-relaxed">
                        ✦ Tim logistik kami akan memverifikasi data dan menghubungi Anda dalam 1x24 jam untuk memandu instruksi pengiriman.
                    </div>
                </div>

                {{-- SUBMIT --}}
                <div class="flex justify-between items-center pt-4">
                    <a href="{{ route('barang.index') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900 transition">
                        ← Kembali
                    </a>
                    <button type="submit" class="bg-emerald-800 hover:bg-emerald-700 text-white text-center px-6 py-3 rounded-xl font-bold text-sm transition shadow-md shadow-emerald-800/10">
                        📦 Kirim Data Barang
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- INTERACTIVE SCRIPT --}}
    <script>
    let rowCount = 1;
    function addRow() {
        const list = document.getElementById('barangList');
        const div = document.createElement('div');
        div.className = 'grid grid-cols-12 gap-2.5 items-center';
        div.innerHTML = `
            <div class="col-span-6">
                <input type="text" name="barang[${rowCount}][nama]" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:outline-none focus:border-emerald-600 focus:bg-white transition" placeholder="Nama barang" required>
            </div>
            <div class="col-span-3">
                <input type="number" name="barang[${rowCount}][jumlah]" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:outline-none focus:border-emerald-600 focus:bg-white transition" placeholder="0" min="1" required>
            </div>
            <div class="col-span-2">
                <select name="barang[${rowCount}][satuan]" class="w-full text-sm bg-slate-50/50 border border-slate-200 rounded-xl px-2 py-3 text-slate-800 focus:outline-none focus:border-emerald-600 focus:bg-white transition" required>
                    <option>kg</option><option>dus</option><option>pcs</option><option>karung</option>
                </select>
            </div>
            <div class="col-span-1 text-center">
                <button type="button" class="text-slate-400 hover:text-rose-600 transition text-lg" onclick="removeRow(this)">×</button>
            </div>`;
        list.appendChild(div);
        rowCount++;
    }
    
    function removeRow(btn) {
        const list = document.getElementById('barangList');
        if (list.children.length > 1) {
            btn.closest('.grid').remove();
        }
    }
    </script>
@endsection