@extends('layouts.app')

@section('title', 'Katalog Kampanye Donasi — Mari Berbagi')

@section('content')
<section class="py-12 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        {{-- SECTION 1: HERO KAMPANYE DARURAT UTAMA (BANNER PALING MENDESAK) --}}
        <div class="bg-gradient-to-br from-red-50 to-orange-50 border border-red-200/60 rounded-3xl p-6 lg:p-8 grid lg:grid-cols-12 gap-8 items-center shadow-sm">
            <div class="lg:col-span-4 relative">
                <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] font-extrabold px-2.5 py-1 rounded-md uppercase tracking-wider animate-pulse z-10">
                    🚨 DARURAT MENDESAK
                </span>
                <img src="https://images.unsplash.com/photo-1594897030264-ab7d87efc473?q=80&w=600&auto=format&fit=crop" 
                     alt="Darurat Bencana Kebakaran" 
                     class="rounded-2xl h-52 w-full object-cover border border-red-100">
            </div>
            <div class="lg:col-span-8 space-y-4">
                <div class="flex items-center gap-2 text-xs font-bold text-red-700">
                    <span>📍 Siantan Hulu, Pontianak Utara</span>
                    <span>•</span>
                    <span>Waktu Tersisa: 2 Hari Lagi</span>
                </div>
                <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 leading-tight">
                    Bantuan Logistik & Pakaian Layak Pakai Korban Kebakaran Pemukiman Siantan
                </h2>
                <p class="text-sm text-slate-600 max-w-2xl leading-relaxed">
                    Lebih dari 15 kepala keluarga kehilangan tempat tinggal akibat kebakaran hebat kemarin malam. Saat ini mereka sangat membutuhkan pakaian balita, tenda darurat, and makanan siap saji.
                </p>
                <div class="pt-2 flex flex-col sm:flex-row items-center gap-3">
                    <div class="w-full sm:w-64 space-y-1">
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-red-600 h-2 rounded-full" style="width: 75%"></div>
                        </div>
                        <div class="flex justify-between text-xs font-bold text-slate-500">
                            <span>Terkumpul: <strong class="text-red-700">Rp 15.200.000</strong></span>
                            <span>75%</span>
                        </div>
                    </div>
                    
                    {{-- Tombol Aksi Kanan Banner --}}
                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <a href="{{ Route::has('donasi.create') ? route('donasi.create') : '#' }}" class="flex-1 sm:flex-none bg-red-600 hover:bg-red-700 text-white text-center text-xs font-bold px-5 py-3 rounded-xl transition shadow-md whitespace-nowrap">
                            Donasi Dana
                        </a>
                        <a href="{{ Route::has('barang.create') ? route('barang.create') : '#' }}" class="flex-1 sm:flex-none bg-white hover:bg-slate-100 text-red-700 border border-red-200 text-center text-xs font-bold px-5 py-3 rounded-xl transition shadow-sm whitespace-nowrap">
                            Donasi Barang
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION 2: HEADER KATALOG & FILTER KATEGORI --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-200 pb-5">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Daftar Program yang Membutuhkan</h1>
                <p class="text-xs text-slate-500 mt-1">Pilih dan salurkan bantuanmu secara transparan untuk panti sosial dan daerah terdampak bencana.</p>
            </div>
            
            <div class="flex flex-wrap gap-2" id="filter-button-group">
                <button data-target="all" class="btn-filter bg-emerald-800 text-white text-xs font-bold px-4 py-2 rounded-xl shadow-sm transition">
                    Semua
                </button>
                <button data-target="Bencana Alam" class="btn-filter bg-white hover:bg-slate-100 text-slate-600 border border-slate-200 text-xs font-semibold px-4 py-2 rounded-xl transition">
                    🌋 Bencana Alam
                </button>
                <button data-target="Panti Sosial" class="btn-filter bg-white hover:bg-slate-100 text-slate-600 border border-slate-200 text-xs font-semibold px-4 py-2 rounded-xl transition">
                    🏡 Panti Sosial
                </button>
            </div>
        </div>

        {{-- PHP MANUAL DUMMY DATA --}}
        @php
            $daftar_kampanye = [
                // --- KATEGORI: PANTI SOSIAL ---
                [
                    'judul' => 'Patungan Sembako & Kasur Layak untuk Anak-Anak Panti Asuhan Ahmad Yani',
                    'kategori' => 'Panti Sosial',
                    'lokasi' => '📍 Sungai Bangkong, Pontianak Kota',
                    'tag' => '🔥 Hampir Terpenuhi',
                    'tag_color' => 'bg-amber-500',
                    'img' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=600&auto=format&fit=crop',
                    'terkumpul' => 'Rp 8.400.000',
                    'target' => 'Rp 10.000.000',
                    'persen' => '84%'
                ],
                [
                    'judul' => 'Renovasi Atap Bocor & Fasilitas Belajar Santri Panti Asuhan Amal Mulia',
                    'kategori' => 'Panti Sosial',
                    'lokasi' => '📍 Kubu Raya, Kalimantan Barat',
                    'tag' => '✨ Penyaluran Rutin',
                    'tag_color' => 'bg-emerald-700',
                    'img' => 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?q=80&w=600&auto=format&fit=crop',
                    'terkumpul' => 'Rp 4.100.000',
                    'target' => 'Rp 15.000.000',
                    'persen' => '27%'
                ],
                [
                    'judul' => 'Peduli Gizi Balita Terlantar: Pengadaan Susu & Vitamin Panti Asuhan Harapan Kita',
                    'kategori' => 'Panti Sosial',
                    'lokasi' => '📍 Pontianak Barat, Kalbar',
                    'tag' => '❤️ Prioritas',
                    'tag_color' => 'bg-pink-600',
                    'img' => 'https://images.unsplash.com/photo-1484662020986-75935d2ebc66?q=80&w=600&auto=format&fit=crop',
                    'terkumpul' => 'Rp 12.300.000',
                    'target' => 'Rp 30.000.000',
                    'persen' => '41%'
                ],

                // --- KATEGORI: BENCANA ALAM ---
                [
                    'judul' => 'Darurat Banjir Bandang Landak: Pengadaan Air Bersih dan Obat-Obatan',
                    'kategori' => 'Bencana Alam',
                    'lokasi' => '📍 Ngabang, Kabupaten Landak',
                    'tag' => '🚨 Butuh Cepat',
                    'tag_color' => 'bg-red-600',
                    'img' => 'https://images.unsplash.com/photo-1547683905-f686c993aae5?q=80&w=600&auto=format&fit=crop',
                    'terkumpul' => 'Rp 24.500.000',
                    'target' => 'Rp 50.000.000',
                    'persen' => '49%'
                ],
                [
                    'judul' => 'Bantuan Kebakaran Hutan & Lahan: Pengadaan Masker Medis dan Oksigen Portabel',
                    'kategori' => 'Bencana Alam',
                    'lokasi' => '📍 Sungai Raya, Kubu Raya',
                    'tag' => '💨 Kondisi Siaga',
                    'slate-700' => 'bg-slate-700',
                    'tag_color' => 'bg-slate-700',
                    'img' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=600&auto=format&fit=crop',
                    'terkumpul' => 'Rp 6.200.000',
                    'target' => 'Rp 20.000.000',
                    'persen' => '31%'
                ],
                [
                    'judul' => 'Dapur Umum untuk Korban Terdampak Banjir Luapan Sungai Kapuas Pontianak',
                    'kategori' => 'Bencana Alam',
                    'lokasi' => '📍 Tambelan Sampit, Pontianak Timur',
                    'tag' => '🍲 Logistik',
                    'tag_color' => 'bg-orange-600',
                    'img' => 'https://images.unsplash.com/photo-1593113598332-cd288d649433?q=80&w=600&auto=format&fit=crop',
                    'terkumpul' => 'Rp 18.900.000',
                    'target' => 'Rp 25.000.000',
                    'persen' => '75%'
                ]
            ];
        @endphp

       {{-- SECTION 3: GRID KATALOG PROGRAM DONASI --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8" id="kampanye-grid">
            @forelse($programs as $item)
            <div class="card-kampanye bg-white rounded-2xl overflow-hidden border border-slate-200/60 shadow-sm hover:shadow-lg transition flex flex-col group" 
                data-category="{{ $item->kategori }}">
                
                <div class="relative overflow-hidden">
                    @if($item->status === 'darurat')
                    <span class="absolute top-3 left-3 text-white text-[9px] font-bold px-2.5 py-1 rounded-md z-10 shadow-sm bg-red-600">
                        🚨 Darurat
                    </span>
                    @endif
                    <img src="{{ $item->gambar ? (str_starts_with($item->gambar, 'http') ? $item->gambar : asset('storage/'.$item->gambar)) : 'https://images.unsplash.com/photo-1594897030264-ab7d87efc473?q=80&w=600&auto=format&fit=crop' }}" 
                         alt="{{ $item->judul }}" class="h-48 w-full object-cover group-hover:scale-102 transition-transform duration-300">
                </div>

                <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-[10px] font-bold text-slate-400">
                            <span class="uppercase tracking-wider px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700">
                                {{ $item->kategori }}
                            </span>
                        </div>
                        <h3 class="font-bold text-base text-slate-900 line-clamp-2 group-hover:text-emerald-800 transition-colors leading-snug">
                            {{ $item->judul }}
                        </h3>
                    </div>
                    
                    <div class="space-y-1.5">
                        <div class="w-full bg-slate-100 rounded-full h-2">
                            <div class="bg-emerald-600/80 h-2 rounded-full" style="width: {{ $item->presentase }}%"></div>
                        </div>
                        <div class="flex justify-between text-xs font-semibold text-slate-500">
                            <span>Terkumpul: <strong class="text-slate-800">Rp {{ number_format($item->dana_terkumpul, 0, ',', '.') }}</strong></span>
                            <span class="text-emerald-700 font-bold">{{ $item->presentase }}%</span>
                        </div>
                    </div>

                    <div class="pt-2 border-t border-slate-100 flex items-center justify-between gap-2">
                        <div>
                            <p class="text-[9px] text-slate-400 uppercase tracking-wider font-semibold">Target Dana</p>
                            <p class="text-xs font-extrabold text-slate-700">Rp {{ number_format($item->target_dana, 0, ',', '.') }}</p>
                        </div>
                        
                        <div class="flex items-center gap-1.5">
                            <a href="{{ route('barang.create', ['program' => $item->id]) }}" class="bg-white hover:bg-slate-50 text-emerald-800 border border-slate-200 px-3 py-2 rounded-xl text-[11px] font-bold transition shadow-sm whitespace-nowrap">
                                Donasi Barang
                            </a>
                            <a href="{{ route('donasi.create', ['program' => $item->id]) }}" class="bg-emerald-800 hover:bg-emerald-700 text-white px-3 py-2 rounded-xl text-[11px] font-bold transition shadow-sm whitespace-nowrap">
                                Donasi Dana
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-slate-400 col-span-3 text-center py-12">Belum ada program donasi aktif saat ini.</p>
            @endforelse
        </div>

    </div>
</section>

{{-- JAVASCRIPT LOGIC UNTUK FILTER KLIK --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".btn-filter");
        const cards = document.querySelectorAll(".card-kampanye");

        buttons.forEach(button => {
            button.addEventListener("click", function () {
                const targetCategory = this.getAttribute("data-target");

                buttons.forEach(btn => {
                    btn.classList.remove("bg-emerald-800", "text-white", "font-bold", "shadow-sm");
                    btn.classList.add("bg-white", "text-slate-600", "border", "border-slate-200", "font-semibold");
                });
                
                this.classList.remove("bg-white", "text-slate-600", "border", "border-slate-200", "font-semibold");
                this.classList.add("bg-emerald-800", "text-white", "font-bold", "shadow-sm");

                cards.forEach(card => {
                    const cardCategory = card.getAttribute("data-category");

                    if (targetCategory === "all" || cardCategory === targetCategory) {
                        card.style.display = "flex";
                    } else {
                        card.style.display = "none";
                    }
                });
            });
        });
    });
</script>
@endsection