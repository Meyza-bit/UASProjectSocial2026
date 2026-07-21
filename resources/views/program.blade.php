@extends('layouts.app')

@section('title', 'Katalog Kampanye Donasi — Mari Berbagi')

@section('content')
<section class="py-12 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        {{-- HEADER KATALOG & FILTER KATEGORI --}}
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

        {{-- GRID KATALOG PROGRAM DONASI --}}
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