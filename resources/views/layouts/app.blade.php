<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Mari Berbagi')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('styles')
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b border-slate-200/80 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <span class="text-xl">🤝</span>
                    <a href="{{ Route::has('home') ? route('home') : '/' }}" class="text-xl font-extrabold text-emerald-950 tracking-tight">
                        Mari<span class="text-emerald-700">Berbagi</span>
                    </a>
                </div>

                <div class="hidden lg:flex items-center gap-6 text-sm font-semibold text-slate-600">
                    <a href="{{ Route::has('home') ? route('home') : '/' }}"
                        class="{{ request()->routeIs('home') ? 'text-emerald-800' : 'hover:text-emerald-800' }} transition">Beranda</a>

                    <a href="{{ Route::has('program.index') ? route('program.index') : '#program-pilihan' }}"
                        class="{{ request()->routeIs('program.*') ? 'text-emerald-800' : 'hover:text-emerald-800' }} transition">Program</a>

                    <a href="{{ Route::has('barang.create') ? route('barang.create') : '#' }}"
                        class="{{ request()->routeIs('barang.*') ? 'text-emerald-800' : 'hover:text-emerald-800' }} transition">Kirim Barang</a>

                    <a href="{{ Route::has('donasi.create') ? route('donasi.create') : '#' }}"
                        class="{{ request()->routeIs('donasi.*') ? 'text-emerald-800' : 'hover:text-emerald-800' }} transition">Donasi Dana</a>

                    <a href="{{ Route::has('transparansi.index') ? route('transparansi.index') : '/transparansi' }}"
                        class="{{ request()->routeIs('transparansi.*') ? 'text-emerald-800' : 'hover:text-emerald-800' }} transition">Transparansi</a>

                    <a href="{{ Route::has('feedback.index') ? route('feedback.index') : '#' }}"
                        class="{{ request()->routeIs('feedback.*') ? 'text-emerald-800' : 'hover:text-emerald-800' }} transition">Feedback</a>
                </div>

                <div class="flex items-center gap-4">
                    {{-- Bagian Autentikasi Login Dinamis --}}
                    @auth
                        {{-- Tampilan jika user sudah berhasil login --}}
                        <div class="flex items-center gap-3 hidden sm:flex">
                            <span class="text-xs font-semibold text-slate-600">
                                Halo, <strong class="text-emerald-950">{{ Auth::user()->name }}</strong>
                            </span>

                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-xs font-bold text-red-600 hover:text-red-800 transition">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    @else
                        {{-- Tampilan jika belum login --}}
                        <a href="{{ Route::has('login') ? route('login') : '/login' }}" class="text-xs font-bold text-emerald-800 hover:text-emerald-950 transition hidden sm:block">
                            Masuk
                        </a>
                    @endauth

                    <a href="{{ Route::has('donasi.create') ? route('donasi.create') : '#' }}" class="bg-emerald-800 hover:bg-emerald-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition shadow-sm">
                        Mulai Donasi
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- KONTEN UTAMA --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-white border-t border-slate-200/80 py-8 text-center text-xs text-slate-500 font-medium">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-2">
            <p class="text-sm font-bold text-emerald-950">🤝 MariBerbagi &copy; 2026</p>
            <p>Wadah kolaborasi inklusif penyaluran bantuan bencana alam dan panti sosial daerah Pontianak secara amanah.</p>
        </div>
    </footer>

</body>
</html>