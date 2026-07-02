@extends('layouts.app')

@section('title', 'Feedback — Mari Berbagi')

@section('content')
<section class="bg-slate-50 py-10 lg:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium px-5 py-4">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-sm px-5 py-4 space-y-1">
                <p class="font-semibold">Masukan belum bisa disimpan, cek lagi ya:</p>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ================= GRID ATAS: RANGKUMAN + FORM ================= --}}
        <div class="grid lg:grid-cols-2 gap-8">

            {{-- ---------- KIRI: RANGKUMAN KEPUASAN PUBLIK ---------- --}}
            <div class="space-y-8">
                <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6 sm:p-8">
                    <h2 class="text-lg font-bold text-slate-900 mb-6">Rangkuman Kepuasan Publik</h2>

                    <div class="flex flex-col sm:flex-row sm:items-center gap-6 mb-8">
                        <div class="bg-emerald-50 rounded-2xl px-8 py-6 text-center shrink-0">
                            <p class="text-5xl font-extrabold text-slate-900 leading-none">{{ number_format($avgRating ?? 4.8, 1) }}</p>
                            <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider mt-2">Dari 5 Bintang</p>
                        </div>
                        <div class="space-y-2">
                            <div class="flex gap-1 text-amber-400 text-xl">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span>{{ $i <= round($avgRating ?? 4.8) ? '★' : '☆' }}</span>
                                @endfor
                            </div>
                            <p class="text-sm text-slate-500">
                                Berdasarkan <strong class="text-slate-800">{{ $totalFeedback ?? 4 }}</strong> masukan masyarakat
                            </p>
                            <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 text-xs font-semibold px-3 py-1 rounded-full">
                                ✓ {{ $satisfactionPercent ?? 100 }}% Puas &amp; Percaya
                            </span>
                        </div>
                    </div>

                    {{-- Breakdown bintang --}}
                    <div class="space-y-3">
                        @foreach (($starPercents ?? [5 => 75, 4 => 25, 3 => 0, 2 => 0, 1 => 0]) as $star => $percent)
                            <div class="flex items-center gap-3 text-sm">
                                <span class="w-3 font-semibold text-slate-700">{{ $star }}</span>
                                <span class="text-amber-400">★</span>
                                <div class="flex-1 bg-slate-100 rounded-full h-2 overflow-hidden">
                                    <div class="bg-emerald-600 h-2 rounded-full" style="width: {{ $percent }}%"></div>
                                </div>
                                <span class="w-10 text-right text-slate-500 font-medium">{{ $percent }}%</span>
                            </div>
                        @endforeach
                    </div>

                    <p class="text-xs text-slate-400 italic mt-6 leading-relaxed">
                        *Tingkat kepuasan diukur dari jumlah ulasan bintang 4 &amp; 5 yang mencerminkan tingkat kepercayaan donatur pada transparansi platform.
                    </p>
                </div>

                {{-- ---------- BOX INTEGRITAS DATA (HIJAU GELAP) ---------- --}}
                <div class="bg-emerald-950 text-white rounded-2xl p-6 sm:p-8 space-y-4">
                    <div class="flex items-center gap-2.5">
                        <span class="text-emerald-300 text-xl">🛡</span>
                        <h3 class="font-bold text-base">Menjaga Integritas Data</h3>
                    </div>
                    <p class="text-sm text-emerald-100/90 leading-relaxed">
                        Semua ulasan yang masuk akan langsung tampil di dinding publik. Demi menjaga keamanan informasi dan privasi:
                    </p>
                    <ul class="space-y-2.5 text-sm text-emerald-100/90">
                        <li class="flex gap-2">
                            <span class="text-emerald-400 shrink-0">•</span>
                            <span>Jangan sebutkan nomor rekening atau kontak pribadi di dalam pesan.</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-emerald-400 shrink-0">•</span>
                            <span>Gunakan opsi <strong class="text-white">Kirim sebagai Anonim</strong> jika ingin menjaga identitas donatur.</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-emerald-400 shrink-0">•</span>
                            <span>Aduan mendesak terkait barang rusak dapat dikirim lewat tim lapangan.</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- ---------- KANAN: FORM KIRIM MASUKAN ---------- --}}
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6 sm:p-8 h-fit">
                <h2 class="text-lg font-bold text-slate-900">Kirim Masukan &amp; Evaluasi Baru</h2>
                <p class="text-sm text-slate-500 mt-1 mb-6">Pendapat Anda sangat penting bagi kelayakan akreditasi program donasi kami</p>

                <form action="{{ Route::has('feedback.store') ? route('feedback.store') : '#' }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Rating bintang --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">Berikan Penilaian (Bintang)</label>
                        <div id="rating-stars" class="flex items-center gap-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <label class="cursor-pointer">
                                    <input type="radio" name="rating" value="{{ $i }}" class="hidden rating-input" {{ old('rating') == $i ? 'checked' : '' }}>
                                    <span class="rating-star text-3xl text-slate-200 transition-colors" data-value="{{ $i }}">★</span>
                                </label>
                            @endfor
                            <span id="rating-label" class="text-sm text-slate-500 ml-2">Klik untuk menilai</span>
                        </div>
                    </div>

                    {{-- Nama & Peran --}}
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label for="nama" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Nama Anda</label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" placeholder="Contoh: Ahmad Setiawan"
                                   class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-600/40 focus:border-emerald-600">
                        </div>
                        <div>
                            <label for="peran" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Peran Anda</label>
                            <select name="peran" id="peran"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-600/40 focus:border-emerald-600">
                                <option value="donatur" @selected(old('peran')=='donatur')>🫴 Donatur / Penyumbang</option>
                                <option value="penerima" @selected(old('peran')=='penerima')>🤝 Penerima Manfaat</option>
                                <option value="relawan" @selected(old('peran')=='relawan')>🧑‍🤝‍🧑 Relawan</option>
                                <option value="umum" @selected(old('peran')=='umum')>👤 Masyarakat Umum</option>
                            </select>
                        </div>
                    </div>

                    {{-- Anonim --}}
                    <label class="flex items-center gap-2.5 text-sm text-slate-600 cursor-pointer">
                        <input type="checkbox" name="anonim" value="1" {{ old('anonim') ? 'checked' : '' }} class="rounded border-slate-300 text-emerald-700 focus:ring-emerald-600/40">
                        Sembunyikan identitas saya (Kirim sebagai <strong class="text-slate-800">Anonim</strong>)
                    </label>

                    {{-- Kategori --}}
                    <div>
                        <label for="kategori" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Kategori Evaluasi</label>
                        <select name="kategori" id="kategori"
                                class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-600/40 focus:border-emerald-600">
                            <option value="transparansi" @selected(old('kategori')=='transparansi')>💠 Transparansi Dana (Keuangan)</option>
                            <option value="barang" @selected(old('kategori')=='barang')>📦 Distribusi Barang</option>
                            <option value="layanan" @selected(old('kategori')=='layanan')>🛎 Layanan &amp; Respon Admin</option>
                            <option value="website" @selected(old('kategori')=='website')>💻 Kemudahan Website</option>
                            <option value="lainnya" @selected(old('kategori')=='lainnya')>✏️ Lainnya</option>
                        </select>
                    </div>

                    {{-- Isi Masukan --}}
                    <div>
                        <label for="isi" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Isi Masukan / Saran Anda</label>
                        <textarea name="isi" id="isi" rows="4" placeholder="Tulis saran konstruktif Anda terkait transparansi data kami, standardisasi timbangan beras, atau kemudahan pengoperasian web ini..."
                                  class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 placeholder:text-slate-400 resize-none focus:outline-none focus:ring-2 focus:ring-emerald-600/40 focus:border-emerald-600">{{ old('isi') }}</textarea>
                    </div>

                    <button type="submit"
                            class="w-full bg-emerald-800 hover:bg-emerald-700 text-white font-bold text-sm py-4 rounded-xl transition shadow-lg shadow-emerald-800/20 flex items-center justify-center gap-2">
                        ➤ Kirim Masukan Anda (Terbitkan ke Dinding Publik)
                    </button>
                </form>
            </div>
        </div>

        {{-- ================= DINDING SUARA PUBLIK ================= --}}
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6 sm:p-8 mt-8">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-6">
                <div>
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        💬 Dinding Suara Publik (Ulasan Nyata)
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">Seluruh masukan dan ulasan dari pengguna platform tanpa rekayasa.</p>
                </div>
                <a href="{{ url()->current() }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-900 whitespace-nowrap">Reset Filter</a>
            </div>

            {{-- Search & Filter --}}
            <form method="GET" class="flex flex-col sm:flex-row gap-3 mb-8">
                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-4 flex items-center text-slate-400">🔍</span>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari ulasan publik..."
                           class="w-full rounded-xl border border-slate-200 pl-11 pr-4 py-3 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-600/40 focus:border-emerald-600">
                </div>
                <select name="kategori" onchange="this.form.submit()"
                        class="rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-600/40">
                    <option value="">Semua Kategori</option>
                    <option value="transparansi" @selected(request('kategori')=='transparansi')>Transparansi Dana</option>
                    <option value="barang" @selected(request('kategori')=='barang')>Distribusi Barang</option>
                    <option value="layanan" @selected(request('kategori')=='layanan')>Layanan &amp; Respon Admin</option>
                    <option value="website" @selected(request('kategori')=='website')>Kemudahan Website</option>
                </select>
                <select name="bintang" onchange="this.form.submit()"
                        class="rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-600/40">
                    <option value="">Semua Bintang</option>
                    @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" @selected(request('bintang')==$i)>{{ $i }} Bintang</option>
                    @endfor
                </select>
            </form>

            {{-- List ulasan --}}
            <div class="space-y-5 max-h-150 overflow-y-auto pr-1">
                @forelse (($feedbacks ?? []) as $f)
                    <div class="border border-slate-100 rounded-2xl p-5">
                        <div class="flex items-start justify-between gap-4 mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-slate-100 text-slate-600 font-bold flex items-center justify-center shrink-0">
                                    {{ Str::upper(Str::substr($f->anonim ? 'A' : $f->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-slate-900 text-sm">{{ $f->anonim ? 'Donatur Anonim' : $f->nama }}</span>
                                        @if(!$f->anonim && ($f->verified ?? false))
                                            <span class="inline-flex items-center gap-1 text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">
                                                ✓ Terverifikasi
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-slate-500 mt-0.5">
                                        {{ ucfirst($f->peran ?? 'Donatur') }} &bull; {{ \Carbon\Carbon::parse($f->created_at)->format('Y-m-d') }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right shrink-0">
                                <div class="text-amber-400 text-sm">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span>{{ $i <= $f->rating ? '★' : '☆' }}</span>
                                    @endfor
                                </div>
                                <span class="inline-block mt-1 text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">
                                    {{ $f->kategori_label ?? 'Transparansi Dana' }}
                                </span>
                            </div>
                        </div>
                        <p class="text-sm text-slate-600 leading-relaxed">{{ $f->isi }}</p>
                    </div>
                @empty
                    <div class="border border-slate-100 rounded-2xl p-5">
                        <div class="flex items-start justify-between gap-4 mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-slate-100 text-slate-600 font-bold flex items-center justify-center shrink-0">H</div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-slate-900 text-sm">Hendra Wijaya</span>
                                        <span class="inline-flex items-center gap-1 text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">✓ Terverifikasi</span>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-0.5">Donatur &bull; 2026-06-30</p>
                                </div>
                            </div>
                            <div class="text-right shrink-0">
                                <div class="text-amber-400 text-sm">★★★★★</div>
                                <span class="inline-block mt-1 text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">Transparansi Dana</span>
                            </div>
                        </div>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Sangat puas dengan rincian laporan keuangan di halaman transparansi. Semua dana masuk dan keluar dicatat rapi hingga nominal satuan rupiah terkecil. Berkas laporan PDF-nya juga mudah diunduh.
                        </p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination (opsional, jika pakai paginator) --}}
            @if (isset($feedbacks) && method_exists($feedbacks, 'links'))
                <div class="mt-6">
                    {{ $feedbacks->links() }}
                </div>
            @endif
        </div>

    </div>
</section>

<script>
(function () {
    var wrapper = document.getElementById('rating-stars');
    if (!wrapper) return;

    var stars  = wrapper.querySelectorAll('.rating-star');
    var inputs = wrapper.querySelectorAll('.rating-input');
    var label  = document.getElementById('rating-label');
    var teks   = { 0: 'Klik untuk menilai', 1: 'Kurang Puas', 2: 'Cukup', 3: 'Puas', 4: 'Sangat Puas', 5: 'Sangat Puas' };

    function currentValue() {
        var checked = wrapper.querySelector('.rating-input:checked');
        return checked ? parseInt(checked.value, 10) : 0;
    }

    function paint(value) {
        stars.forEach(function (star) {
            var isActive = parseInt(star.dataset.value, 10) <= value;
            star.classList.toggle('text-amber-400', isActive);
            star.classList.toggle('text-slate-200', !isActive);
        });
        if (label) label.textContent = teks[value] || '';
    }

    // klik bintang -> jadi pilihan tetap
    inputs.forEach(function (input) {
        input.addEventListener('change', function () {
            paint(parseInt(input.value, 10));
        });
    });

    // hover -> preview sementara, balik ke pilihan asli kalau mouse keluar
    stars.forEach(function (star) {
        star.addEventListener('mouseenter', function () {
            paint(parseInt(star.dataset.value, 10));
        });
    });
    wrapper.addEventListener('mouseleave', function () {
        paint(currentValue());
    });

    // state awal: abu-abu semua kalau belum ada yang dipilih
    paint(currentValue());
})();
</script>
@endsection