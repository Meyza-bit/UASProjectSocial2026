@extends('layouts.app')

@section('title', 'Transparansi Informasi — Mari Berbagi')

@section('content')
<section class="py-8 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        {{-- SECTION 1: TAB NAVIGATION --}}
        <div class="border-b border-slate-200">
            <div class="flex flex-nowrap overflow-x-auto pb-px space-x-2 scrollbar-none items-center justify-between">
                <div class="flex space-x-1" id="transparency-tabs">
                    {{-- Tab 1: Dana (Active Default) --}}
                    <button data-target="tab-dana" class="tab-btn flex items-center gap-2 px-5 py-3 text-xs font-bold text-slate-800 bg-white rounded-t-xl border border-b-0 border-slate-200 shadow-sm relative z-10 whitespace-nowrap transition-all duration-200">
                        🏛️ Transparansi Dana (Uang)
                    </button>
                    {{-- Tab 2: Logistik --}}
                    <button data-target="tab-logistik" class="tab-btn flex items-center gap-2 px-5 py-3 text-xs font-bold text-slate-500 hover:text-slate-700 whitespace-nowrap bg-slate-100/80 rounded-t-xl border border-b-0 border-slate-200/60 transition-all duration-200">
                        📦 Transparansi Logistik (Barang/Sembako)
                    </button>
                </div>
                <div class="text-[11px] text-slate-400 whitespace-nowrap pl-4 hidden md:block">
                    Penyelarasan Terakhir: <span class="font-medium text-slate-500">Hari ini, 10:20 WIB</span>
                </div>
            </div>
        </div>

        {{-- CONTAINER KONTEN UTAMA --}}
        <div id="transparency-content">

            {{-- ==================== KONTEN TAB 1: TRANSPARANSI DANA ==================== --}}
            <div id="tab-dana" class="tab-panel space-y-8 animate-fadeIn">
                {{-- 4 Grid Stats Card (Dana) - Sudah Diseragamkan Warnanya --}}
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm space-y-1">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Dana Masuk</p>
                        <h3 class="text-2xl font-extrabold text-slate-900">Rp 148.500.000</h3>
                        <div class="pt-1 flex items-center gap-1.5 text-[11px] text-emerald-600 font-medium">
                            <span>▲ 12% dari minggu lalu</span>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm space-y-1">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Dana Dialokasikan</p>
                        <h3 class="text-2xl font-extrabold text-slate-900">Rp 92.400.000</h3>
                        <div class="w-full bg-slate-100 rounded-full h-1.5 mt-2">
                            <div class="bg-emerald-600 h-1.5 rounded-full" style="width: 62%"></div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm space-y-1">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Saldo Kas Aktif</p>
                        <h3 class="text-2xl font-extrabold text-slate-900">Rp 56.100.000</h3>
                        <p class="text-xs text-slate-500">Siap disalurkan darurat</p>
                    </div>
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm space-y-1">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Audit Transparansi</p>
                        <h3 class="text-2xl font-extrabold text-slate-900">WTP <span class="text-xs font-bold px-2 py-0.5 bg-slate-100 rounded-md text-slate-600">Verifikator</span></h3>
                        <p class="text-xs text-slate-500">Wajar Tanpa Pengecualian</p>
                    </div>
                </div>

                {{-- TABEL RIWAYAT DISTRIBUSI DANA --}}
                <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm space-y-6">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                        <div class="relative w-full lg:w-96">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400 text-xs">🔍</span>
                            <input type="text" id="search-dana" placeholder="Cari program atau pihak penerima dana..." 
                                   class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-700 focus:outline-none focus:border-emerald-600 focus:bg-white transition-all">
                        </div>
                        <div class="flex flex-wrap items-center gap-1.5" id="dana-filter-group">
                            <span class="text-slate-400 text-[11px] font-bold mr-1">⏳ Filter:</span>
                            <button data-filter="all" class="btn-dana-filter bg-emerald-600 text-white text-[11px] font-bold px-3 py-1.5 rounded-lg shadow-sm transition">Semua</button>
                            <button data-filter="Bencana Alam" class="btn-dana-filter bg-white hover:bg-slate-50 text-slate-600 border border-slate-200 text-[11px] font-medium px-3 py-1.5 rounded-lg transition">Bencana Alam</button>
                            <button data-filter="Panti Sosial" class="btn-dana-filter bg-white hover:bg-slate-50 text-slate-600 border border-slate-200 text-[11px] font-medium px-3 py-1.5 rounded-lg transition">Panti Sosial</button>

                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs whitespace-nowrap min-w-[900px]">
                            <thead>
                                <tr class="border-b border-slate-200/60 text-slate-400 font-bold uppercase tracking-wider text-[10px]">
                                    <th class="pb-3 pl-2 w-28">Tanggal Distribusi</th>
                                    <th class="pb-3 w-72">Nama Program Yang Dibantu</th>
                                    <th class="pb-3 w-32">Kategori</th>
                                    <th class="pb-3 w-32">Dana Cair</th>
                                    <th class="pb-3 w-48">Pihak Penerima</th>
                                    <th class="pb-3 w-40 text-center">Status Berkas</th>
                                    <th class="pb-3 pr-2 w-32 text-center">Bukti/Dokumen</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-600 font-medium" id="body-tabel-dana">
                                <tr class="row-dana-data" data-category="Bencana Alam">
                                    <td class="py-4 pl-2 text-slate-400 font-mono">2026-06-28</td>
                                    <td class="py-4 font-bold text-slate-900 pr-4 whitespace-normal">Bantuan Pangan Korban Banjir Pontianak</td>
                                    <td class="py-4"><span class="bg-orange-50 text-orange-700 border border-orange-200/50 px-2.5 py-1 rounded-md font-bold text-[10px]">Bencana Alam</span></td>
                                    <td class="py-4 font-mono font-bold text-slate-900">Rp 45.000.000</td>
                                    <td class="py-4 text-slate-500 whitespace-normal pr-4">Posko Utama Banjir Pontianak Barat</td>
                                    <td class="py-4 text-center"><span class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full text-[10px] font-bold border border-emerald-200/50">✓ Lengkap</span></td>
                                    <td class="py-4 text-center"><button class="bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 px-3 py-1.5 rounded-lg font-bold text-[11px] transition shadow-sm">📥 Unduh Laporan</button></td>
                                </tr>
                                <tr class="row-dana-data" data-category="Panti Sosial">
                                    <td class="py-4 pl-2 text-slate-400 font-mono">2026-06-25</td>
                                    <td class="py-4 font-bold text-slate-900 pr-4 whitespace-normal">Santunan Pendidikan Anak Yatim Panti Asuhan Al-Amin</td>
                                    <td class="py-4"><span class="bg-blue-50 text-blue-700 border border-blue-200/50 px-2.5 py-1 rounded-md font-bold text-[10px]">Panti Sosial</span></td>
                                    <td class="py-4 font-mono font-bold text-slate-900">Rp 18.500.000</td>
                                    <td class="py-4 text-slate-500 whitespace-normal pr-4">Pengurus Panti Al-Amin Pontianak</td>
                                    <td class="py-4 text-center"><span class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full text-[10px] font-bold border border-emerald-200/50">✓ Lengkap</span></td>
                                    <td class="py-4 text-center"><button class="bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 px-3 py-1.5 rounded-lg font-bold text-[11px] transition shadow-sm">📥 Unduh Laporan</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            {{-- ==================== KONTEN TAB 2: TRANSPARANSI LOGISTIK ==================== --}}
            <div id="tab-logistik" class="tab-panel hidden space-y-8 animate-fadeIn">
                
                {{-- 4 Grid Stats Card Terbuka - Visual Warna Hitam/Slate Sudah Seragam Semuanya --}}
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    {{-- Card Kategori 1 --}}
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm space-y-1">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Sembako / Bahan Pangan</p>
                        <h3 class="text-2xl font-extrabold text-slate-900">1,730.5 <span class="text-xs font-bold text-slate-500">Items / Kg / pcs / Dus</span></h3>
                        <p class="text-xs text-slate-500">Beras, minyak goreng, gula, mi instan</p>
                    </div>
                    {{-- Card Kategori 2 --}}
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm space-y-1">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Pakaian Layak Pakai</p>
                        <h3 class="text-2xl font-extrabold text-slate-900">820 <span class="text-xs font-bold text-slate-500">Pcs</span></h3>
                        <p class="text-xs text-slate-500">Telah disortir & disetrika steril</p>
                    </div>
                    {{-- Card Kategori 3 --}}
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm space-y-1">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Obat-obatan & Medis</p>
                        <h3 class="text-2xl font-extrabold text-slate-900">75 <span class="text-xs font-bold text-slate-500">Box / Paket</span></h3>
                        <p class="text-xs text-slate-500">Masker, P3K, obat suplemen darurat</p>
                    </div>
                    {{-- Card Kategori 4 --}}
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm space-y-1">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Perlengkapan Bayi & Anak</p>
                        <h3 class="text-2xl font-extrabold text-slate-900">310 <span class="text-xs font-bold text-slate-500">Paket</span></h3>
                        <p class="text-xs text-slate-500">Popok bayi, susu formula, bubur instan</p>
                    </div>
                </div>

                {{-- TABEL RIWAYAT DISTRIBUSI BARANG LOGISTIK --}}
                <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm space-y-6">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                        {{-- Search Bar --}}
                        <div class="relative w-full lg:w-80 shrink-0">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400 text-xs">🔍</span>
                            <input type="text" id="search-logistik-table" placeholder="Cari penyaluran barang..." 
                                   class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-700 focus:outline-none focus:border-emerald-600 focus:bg-white transition-all">
                        </div>
                        
                        {{-- Filter Pill Kategori: Memanjang Horizontal & Bisa Digeser Menyamping --}}
                        <div class="w-full lg:w-auto flex items-center gap-1.5 overflow-hidden">
                            <span class="text-slate-400 text-[11px] font-bold shrink-0 hidden sm:inline">⏳ Filter:</span>
                            <div class="flex flex-nowrap overflow-x-auto pb-1.5 sm:pb-0 gap-1.5 scrollbar-none w-full" id="logistik-filter-group">
                                <button data-filter="all" class="btn-logistik-filter shrink-0 bg-emerald-600 text-white text-[11px] font-bold px-3 py-1.5 rounded-lg shadow-sm transition">Semua</button>
                                <button data-filter="Sembako / Bahan Pangan" class="btn-logistik-filter shrink-0 bg-white hover:bg-slate-50 text-slate-600 border border-slate-200 text-[11px] font-medium px-3 py-1.5 rounded-lg transition whitespace-nowrap">Sembako / Bahan Pangan</button>
                                <button data-filter="Pakaian Layak Pakai" class="btn-logistik-filter shrink-0 bg-white hover:bg-slate-50 text-slate-600 border border-slate-200 text-[11px] font-medium px-3 py-1.5 rounded-lg transition whitespace-nowrap">Pakaian Layak Pakai</button>
                                <button data-filter="Obat-obatan & Medis" class="btn-logistik-filter shrink-0 bg-white hover:bg-slate-50 text-slate-600 border border-slate-200 text-[11px] font-medium px-3 py-1.5 rounded-lg transition whitespace-nowrap">Obat-obatan & Medis</button>
                                <button data-filter="Perlengkapan Bayi & Anak" class="btn-logistik-filter shrink-0 bg-white hover:bg-slate-50 text-slate-600 border border-slate-200 text-[11px] font-medium px-3 py-1.5 rounded-lg transition whitespace-nowrap">Perlengkapan Bayi & Anak</button>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs whitespace-nowrap min-w-[900px]">
                            <thead>
                                <tr class="border-b border-slate-200/60 text-slate-400 font-bold uppercase tracking-wider text-[10px]">
                                    <th class="pb-3 pl-2 w-28">Tanggal Penyaluran</th>
                                    <th class="pb-3 w-72">Nama Program Distribusi</th>
                                    <th class="pb-3 w-32">Kategori</th>
                                    <th class="pb-3 w-32">Volume Barang</th>
                                    <th class="pb-3 w-48">Pihak Penerima</th>
                                    <th class="pb-3 w-40 text-center">Status Berkas</th>
                                    <th class="pb-3 pr-2 w-32 text-center">Bukti/Dokumen</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-600 font-medium" id="body-tabel-logistik">
                                <tr class="row-logistik-data" data-category="Sembako / Bahan Pangan">
                                    <td class="py-4 pl-2 text-slate-400 font-mono">2026-06-20</td>
                                    <td class="py-4 font-bold text-slate-900 pr-4 whitespace-normal">Penyaluran Beras, Minyak Goreng & Mi Instan Korban Kebakaran Siantan</td>
                                    <td class="py-4"><span class="bg-emerald-50 text-emerald-700 border border-emerald-200/50 px-2.5 py-1 rounded-md font-bold text-[10px]">Sembako / Bahan Pangan</span></td>
                                    {{-- Volume barang diperbaiki logikanya: kg, Liter, dan Dus --}}
                                    <td class="py-4 font-mono font-bold text-slate-900">450 kg, 120 pcs & 25 Dus</td>
                                    <td class="py-4 text-slate-500 whitespace-normal pr-4">Posko Darurat Siantan Hulu</td>
                                    <td class="py-4 text-center"><span class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full text-[10px] font-bold border border-emerald-200/50">✓ Lengkap</span></td>
                                    <td class="py-4 text-center"><button class="bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 px-3 py-1.5 rounded-lg font-bold text-[11px] transition shadow-sm">📥 Unduh Surat Jalan</button></td>
                                </tr>
                                <tr class="row-logistik-data" data-category="Pakaian Layak Pakai">
                                    <td class="py-4 pl-2 text-slate-400 font-mono">2026-06-15</td>
                                    <td class="py-4 font-bold text-slate-900 pr-4 whitespace-normal">Distribusi Pakaian Layak Pakai & Kasur Busa Anak Panti</td>
                                    <td class="py-4"><span class="bg-blue-50 text-blue-700 border border-blue-200/50 px-2.5 py-1 rounded-md font-bold text-[10px]">Pakaian Layak Pakai</span></td>
                                    <td class="py-4 font-mono font-bold text-slate-900">140 Pcs & 10 Unit</td>
                                    <td class="py-4 text-slate-500 whitespace-normal pr-4">Panti Asuhan Ahmad Yani</td>
                                    <td class="py-4 text-center"><span class="bg-amber-50 text-amber-700 px-3 py-1 rounded-full text-[10px] font-bold border border-amber-200/60">🕒 Proses Verifikasi</span></td>
                                    <td class="py-4 text-center"><button class="bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 px-3 py-1.5 rounded-lg font-bold text-[11px] transition shadow-sm">📥 Unduh Surat Jalan</button></td>
                                </tr>
                                <tr class="row-logistik-data" data-category="Obat-obatan & Medis">
                                    <td class="py-4 pl-2 text-slate-400 font-mono">2026-06-12</td>
                                    <td class="py-4 font-bold text-slate-900 pr-4 whitespace-normal">Penyediaan Masker Medis dan P3K untuk Posko Banjir</td>
                                    <td class="py-4"><span class="bg-purple-50 text-purple-700 border border-purple-200/50 px-2.5 py-1 rounded-md font-bold text-[10px]">Obat-obatan & Medis</span></td>
                                    <td class="py-4 font-mono font-bold text-slate-900">50 Box & 25 Paket</td>
                                    <td class="py-4 text-slate-500 whitespace-normal pr-4">Layanan Kesehatan Pontianak Timur</td>
                                    <td class="py-4 text-center"><span class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full text-[10px] font-bold border border-emerald-200/50">✓ Lengkap</span></td>
                                    <td class="py-4 text-center"><button class="bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 px-3 py-1.5 rounded-lg font-bold text-[11px] transition shadow-sm">📥 Unduh Surat Jalan</button></td>
                                </tr>
                                <tr class="row-logistik-data" data-category="Perlengkapan Bayi & Anak">
                                    <td class="py-4 pl-2 text-slate-400 font-mono">2026-06-08</td>
                                    <td class="py-4 font-bold text-slate-900 pr-4 whitespace-normal">Penyaluran Paket Susu Bayi dan Popok Balita Stunting</td>
                                    <td class="py-4"><span class="bg-pink-50 text-pink-700 border border-pink-200/50 px-2.5 py-1 rounded-md font-bold text-[10px]">Perlengkapan Bayi & Anak</span></td>
                                    <td class="py-4 font-mono font-bold text-slate-900">120 Paket</td>
                                    <td class="py-4 text-slate-500 whitespace-normal pr-4">Puskesmas Pontianak Kota</td>
                                    <td class="py-4 text-center"><span class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full text-[10px] font-bold border border-emerald-200/50">✓ Lengkap</span></td>
                                    <td class="py-4 text-center"><button class="bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 px-3 py-1.5 rounded-lg font-bold text-[11px] transition shadow-sm">📥 Unduh Surat Jalan</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- LOGIKA JAVASCRIPT LENGKAP --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        
        // 1. SWITCH TAB UTAMA (Dana vs Logistik)
        const tabs = document.querySelectorAll(".tab-btn");
        const panels = document.querySelectorAll(".tab-panel");

        tabs.forEach(tab => {
            tab.addEventListener("click", function () {
                const targetPanelId = this.getAttribute("data-target");

                tabs.forEach(btn => {
                    btn.className = "tab-btn flex items-center gap-2 px-5 py-3 text-xs font-bold text-slate-500 hover:text-slate-700 whitespace-nowrap bg-slate-100/80 rounded-t-xl border border-b-0 border-slate-200/60 transition-all duration-200";
                });

                if(targetPanelId === "tab-dana") {
                    this.className = "tab-btn flex items-center gap-2 px-5 py-3 text-xs font-bold text-slate-800 bg-white rounded-t-xl border border-b-0 border-slate-200 shadow-sm relative z-10 whitespace-nowrap transition-all duration-200";
                } else {
                    this.className = "tab-btn flex items-center gap-2 px-5 py-3 text-xs font-bold text-emerald-800 bg-white rounded-t-xl border border-b-0 border-slate-200 shadow-sm relative z-10 whitespace-nowrap transition-all duration-200";
                }

                panels.forEach(panel => {
                    if (panel.id === targetPanelId) {
                        panel.classList.remove("hidden");
                    } else {
                        panel.classList.add("hidden");
                    }
                });
            });
        });

        // 2. SEARCH & FILTER UNTUK TABEL DANA
        const searchDana = document.getElementById("search-dana");
        const filterDanaBtns = document.querySelectorAll(".btn-dana-filter");
        const rowDana = document.querySelectorAll(".row-dana-data");
        let activeDanaFilter = "all";
        let searchDanaQuery = "";

        function filterTabelDana() {
            rowDana.forEach(row => {
                const cat = row.getAttribute("data-category");
                const textProg = row.cells[1].textContent.toLowerCase();
                const textRecv = row.cells[4].textContent.toLowerCase();
                const matchCat = (activeDanaFilter === "all" || cat === activeDanaFilter);
                const matchSearch = textProg.includes(searchDanaQuery) || textRecv.includes(searchDanaQuery);
                row.style.display = (matchCat && matchSearch) ? "" : "none";
            });
        }

        searchDana.addEventListener("input", function() {
            searchDanaQuery = this.value.toLowerCase();
            filterTabelDana();
        });

        filterDanaBtns.forEach(btn => {
            btn.addEventListener("click", function() {
                activeDanaFilter = this.getAttribute("data-filter");
                filterDanaBtns.forEach(b => b.className = "btn-dana-filter bg-white hover:bg-slate-50 text-slate-600 border border-slate-200 text-[11px] font-medium px-3 py-1.5 rounded-lg transition");
                this.className = "btn-dana-filter bg-emerald-600 text-white text-[11px] font-bold px-3 py-1.5 rounded-lg shadow-sm transition";
                filterTabelDana();
            });
        });

        // 3. SEARCH & FILTER UNTUK TABEL LOGISTIK
        const searchLogistik = document.getElementById("search-logistik-table");
        const filterLogistikBtns = document.querySelectorAll(".btn-logistik-filter");
        const rowLogistik = document.querySelectorAll(".row-logistik-data");
        let activeLogistikFilter = "all";
        let searchLogistikQuery = "";

        function filterTabelLogistik() {
            rowLogistik.forEach(row => {
                const cat = row.getAttribute("data-category");
                const textProg = row.cells[1].textContent.toLowerCase();
                const textRecv = row.cells[4].textContent.toLowerCase();
                const matchCat = (activeLogistikFilter === "all" || cat === activeLogistikFilter);
                const matchSearch = textProg.includes(searchLogistikQuery) || textRecv.includes(searchLogistikQuery);
                row.style.display = (matchCat && matchSearch) ? "" : "none";
            });
        }

        searchLogistik.addEventListener("input", function() {
            searchLogistikQuery = this.value.toLowerCase();
            filterTabelLogistik();
        });

        filterLogistikBtns.forEach(btn => {
            btn.addEventListener("click", function() {
                activeLogistikFilter = this.getAttribute("data-filter");
                filterLogistikBtns.forEach(b => b.className = "btn-logistik-filter shrink-0 bg-white hover:bg-slate-50 text-slate-600 border border-slate-200 text-[11px] font-medium px-3 py-1.5 rounded-lg transition whitespace-nowrap");
                this.className = "btn-logistik-filter shrink-0 bg-emerald-600 text-white text-[11px] font-bold px-3 py-1.5 rounded-lg shadow-sm transition whitespace-nowrap";
                filterTabelLogistik();
            });
        });

    });
</script>

<style>
    .animate-fadeIn { animation: fadeIn 0.25s ease-in-out forwards; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(4px); } to { opacity: 1; transform: translateY(0); } }
    .scrollbar-none::-webkit-scrollbar { display: none; }
    .scrollbar-none { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endsection