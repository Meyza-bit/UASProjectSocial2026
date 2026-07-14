@extends('layouts.app')

@section('title', 'Profil Saya — Mari Berbagi')

@section('content')
<section class="bg-slate-50 py-10 lg:py-14">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium px-5 py-4">
                ✓ {{ session('success') }}
            </div>
        @endif

        {{-- ================= INFO PROFIL ================= --}}
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6 sm:p-8 mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center gap-5">
                <div class="w-16 h-16 rounded-full bg-emerald-800 text-white text-2xl font-bold flex items-center justify-center shrink-0">
                    {{ Str::upper(Str::substr($user->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <h1 class="text-xl font-bold text-slate-900">{{ $user->name }}</h1>
                        @if ($totalKontribusi > 0)
                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full">
                                ✓ Donatur Aktif
                            </span>
                        @endif
                    </div>
                    <p class="text-sm text-slate-500 mt-1">{{ $user->email }}</p>
                    @if ($user->no_hp ?? false)
                        <p class="text-sm text-slate-500">{{ $user->no_hp }}</p>
                    @endif
                    <p class="text-xs text-slate-400 mt-1">Bergabung sejak {{ $user->created_at->translatedFormat('F Y') }}</p>
                </div>
                <a href="#edit-profil" class="text-sm font-semibold text-emerald-700 hover:text-emerald-900 border border-emerald-200 hover:border-emerald-400 rounded-xl px-4 py-2.5 transition whitespace-nowrap">
                    Ubah Profil
                </a>
            </div>
        </div>

        {{-- ================= KARTU RINGKASAN KONTRIBUSI ================= --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-2xl border border-slate-200/60 p-5">
                <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Total Donasi Dana</p>
                <p class="text-lg font-bold text-slate-900 mt-1.5">Rp {{ number_format($totalDana, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200/60 p-5">
                <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Pengiriman Barang</p>
                <p class="text-lg font-bold text-slate-900 mt-1.5">{{ $totalPengirimanBarang }} kali</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200/60 p-5">
                <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Total Kontribusi</p>
                <p class="text-lg font-bold text-slate-900 mt-1.5">{{ $totalKontribusi }} kali</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200/60 p-5">
                <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Program Dibantu</p>
                <p class="text-lg font-bold text-slate-900 mt-1.5">{{ $programDibantu }} program</p>
            </div>
        </div>

        {{-- ================= TAB RIWAYAT DONASI ================= --}}
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6 sm:p-8">
            <h2 class="text-lg font-bold text-slate-900 mb-5">Riwayat Donasi</h2>

            {{-- Tombol tab --}}
            <div id="tab-buttons" class="flex gap-2 border-b border-slate-100 mb-6">
                <button type="button" data-tab="dana" class="tab-btn px-4 py-2.5 text-sm font-semibold border-b-2 border-emerald-700 text-emerald-800">
                    Donasi Dana ({{ $riwayatDana->count() }})
                </button>
                <button type="button" data-tab="barang" class="tab-btn px-4 py-2.5 text-sm font-semibold border-b-2 border-transparent text-slate-500 hover:text-slate-700">
                    Donasi Barang ({{ $riwayatBarang->count() }})
                </button>
            </div>

            {{-- ---------- TAB: DONASI DANA ---------- --}}
            <div id="tab-dana" class="tab-panel space-y-3">
                @forelse ($riwayatDana as $dana)
                    <div class="flex items-center justify-between gap-4 border border-slate-100 rounded-xl p-4">
                        <div class="min-w-0">
                            <p class="text-sm font-bold text-slate-900 truncate">{{ $dana->program->judul ?? $dana->program->nama ?? 'Program tidak diketahui' }}</p>
                            <p class="text-xs text-slate-500 mt-0.5">{{ $dana->created_at->translatedFormat('d M Y') }}</p>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="text-sm font-bold text-slate-900">Rp {{ number_format($dana->nominal, 0, ',', '.') }}</p>
                            @php
                                $statusMap = [
                                    'pending'  => ['🟡 Menunggu Verifikasi', 'bg-amber-50 text-amber-700'],
                                    'verified' => ['🟢 Terverifikasi', 'bg-emerald-50 text-emerald-700'],
                                    'ditolak'  => ['🔴 Ditolak', 'bg-rose-50 text-rose-700'],
                                ];
                                [$label, $badgeClass] = $statusMap[$dana->status] ?? ['Status tidak diketahui', 'bg-slate-100 text-slate-600'];
                            @endphp
                            <span class="inline-block mt-1 text-[11px] font-semibold px-2.5 py-1 rounded-full {{ $badgeClass }}">{{ $label }}</span>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 italic text-center py-8">Kamu belum pernah donasi dana.</p>
                @endforelse
            </div>

            {{-- ---------- TAB: DONASI BARANG ---------- --}}
            <div id="tab-barang" class="tab-panel space-y-3 hidden">
                @forelse ($riwayatBarang as $barang)
                    <div class="border border-slate-100 rounded-xl p-4">
                        <div class="flex items-center justify-between gap-4 mb-2">
                            <p class="text-sm font-bold text-slate-900 truncate">{{ $barang->program->judul ?? $barang->program->nama ?? 'Program tidak diketahui' }}</p>
                            @php
                                $statusMapBarang = [
                                    'pending'  => ['🟡 Menunggu Verifikasi', 'bg-amber-50 text-amber-700'],
                                    'diterima' => ['🟢 Diterima', 'bg-emerald-50 text-emerald-700'],
                                    'ditolak'  => ['🔴 Ditolak', 'bg-rose-50 text-rose-700'],
                                ];
                                [$labelB, $badgeClassB] = $statusMapBarang[$barang->status] ?? ['Status tidak diketahui', 'bg-slate-100 text-slate-600'];
                            @endphp
                            <span class="shrink-0 text-[11px] font-semibold px-2.5 py-1 rounded-full {{ $badgeClassB }}">{{ $labelB }}</span>
                        </div>
                        <p class="text-xs text-slate-500 mb-2">{{ $barang->created_at->translatedFormat('d M Y') }}</p>
                        @if ($barang->items ?? false)
                            <p class="text-xs text-slate-600">
                                {{ $barang->items->pluck('nama_barang')->join(', ') }}
                            </p>
                        @endif
                    </div>
                @empty
                    <p class="text-sm text-slate-400 italic text-center py-8">Kamu belum pernah kirim barang.</p>
                @endforelse
            </div>
        </div>

        {{-- ================= FORM UBAH PROFIL ================= --}}
        <div id="edit-profil" class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6 sm:p-8 mt-8">
            <h2 class="text-lg font-bold text-slate-900 mb-5">Ubah Profil</h2>

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-5 max-w-lg">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                           class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-600/40 focus:border-emerald-600">
                    @error('name') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                           class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-600/40 focus:border-emerald-600">
                    @error('email') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="no_hp" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">No. HP (opsional)</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $user->no_hp ?? '') }}"
                           class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-600/40 focus:border-emerald-600">
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Password Baru (opsional)</label>
                        <input type="password" name="password" id="password" placeholder="Kosongkan jika tidak ganti"
                               class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-600/40 focus:border-emerald-600">
                        @error('password') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-600/40 focus:border-emerald-600">
                    </div>
                </div>

                <button type="submit" class="bg-emerald-800 hover:bg-emerald-700 text-white font-bold text-sm px-6 py-3 rounded-xl transition shadow-sm">
                    Simpan Perubahan
                </button>
            </form>
        </div>

    </div>
</section>

<script>
(function () {
    var buttons = document.querySelectorAll('.tab-btn');
    var panels  = { dana: document.getElementById('tab-dana'), barang: document.getElementById('tab-barang') };

    function activate(tab) {
        buttons.forEach(function (btn) {
            var isActive = btn.dataset.tab === tab;
            btn.classList.toggle('border-emerald-700', isActive);
            btn.classList.toggle('text-emerald-800', isActive);
            btn.classList.toggle('border-transparent', !isActive);
            btn.classList.toggle('text-slate-500', !isActive);
        });
        Object.keys(panels).forEach(function (key) {
            panels[key].classList.toggle('hidden', key !== tab);
        });
    }

    buttons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            activate(btn.dataset.tab);
        });
    });

    // Kalau datang dari link "Riwayat Donasi" di dropdown navbar (?tab=riwayat), langsung buka tab dana
    var initialTab = @json($tabAktif) === 'riwayat' ? 'dana' : 'dana';
    activate(initialTab);
})();
</script>
@endsection