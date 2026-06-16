<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Mari Berbagi')</title>
    
<<<<<<< feature/halaman-barang
    <!-- Fonts -->
=======
>>>>>>> main
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<<<<<<< feature/halaman-barang
    <!-- Tailwind CSS (Vite / Bawaan Laravel) -->
=======
>>>>>>> main
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
<<<<<<< feature/halaman-barang
                <!-- Logo -->
=======
>>>>>>> main
                <div class="flex items-center gap-2">
                    <span class="text-xl">🤝</span>
                    <a href="{{ Route::has('home') ? route('home') : '/' }}" class="text-xl font-extrabold text-emerald-950 tracking-tight">
                        Mari<span class="text-emerald-700">Berbagi</span>
                    </a>
                </div>

<<<<<<< feature/halaman-barang
                <!-- Menu Navigasi Sesuai Branch GitHub (image_3e4316.png) -->
                <div class="hidden lg:flex items-center gap-6 text-sm font-semibold text-slate-600">
                    <a href="{{ Route::has('home') ? route('home') : '/' }}" class="hover:text-emerald-800 transition">Beranda</a>

                    <a href="{{ Route::has('program.index') ? route('program.index') : '#program-pilihan' }}" class="hover:text-emerald-800 transition">Program</a>
                    
                    <a href="{{ Route::has('barang.create') ? route('barang.create') : '#' }}" class="text-emerald-800 hover:text-emerald-900 transition">Kirim Barang</a>
                    
                    <a href="{{ Route::has('donasi.create') ? route('donasi.create') : '#' }}" class="hover:text-emerald-800 transition">Donasi Dana</a>
                    
                    <a href="{{ Route::has('transparansi') ? route('transparansi') : '#' }}" class="hover:text-emerald-800 transition">Transparansi</a>
=======
                <div class="hidden lg:flex items-center gap-6 text-sm font-semibold text-slate-600">
                    <a href="{{ Route::has('home') ? route('home') : '/' }}" class="text-emerald-800 hover:text-emerald-900 transition">Beranda</a>
                    
                    <a href="{{ Route::has('program.index') ? route('program.index') : '#program-pilihan' }}" class="hover:text-emerald-800 transition">Program</a>
                    
                    <a href="{{ Route::has('barang.create') ? route('barang.create') : '#' }}" class="hover:text-emerald-800 transition">Kirim Barang</a>
                    
                    <a href="{{ Route::has('donasi.create') ? route('donasi.create') : '#' }}" class="hover:text-emerald-800 transition">Donasi Dana</a>
                    
                    {{-- Ini yang sudah diperbaiki rutenya jadi transparansi.index --}}
                    <a href="{{ Route::has('transparansi.index') ? route('transparansi.index') : '/transparansi' }}" class="hover:text-emerald-800 transition">Transparansi</a>
>>>>>>> main
                    
                    <a href="{{ Route::has('feedback.index') ? route('feedback.index') : '#' }}" class="hover:text-emerald-800 transition">Feedback</a>
                </div>

<<<<<<< feature/halaman-barang
                <!-- Tombol Aksi Masuk / Daftar -->
=======
>>>>>>> main
                <div class="flex items-center gap-4">
                    <a href="#" class="text-xs font-bold text-emerald-800 hover:text-emerald-950 transition hidden sm:block">Masuk</a>
                    <a href="{{ Route::has('donasi.create') ? route('donasi.create') : '#' }}" class="bg-emerald-800 hover:bg-emerald-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition shadow-sm">
                        Mulai Donasi
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- KONTEN UTAMA --}}
<<<<<<< feature/halaman-barang
    <main class="grow">
=======
    <main class="flex-grow">
>>>>>>> main
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