<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Admin')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        .active-nav { bg-color: #1e293b !important; color: #ffffff !important; }
    </style>
</head>
<body class="bg-slate-100 font-sans antialiased">
    <div class="flex min-h-screen">
        
        {{-- SIDEBAR NAVIGASI --}}
        <aside class="w-64 bg-slate-900 text-slate-300 shrink-0 hidden md:flex flex-col border-r border-slate-800">
            <div class="p-5 border-b border-slate-800 flex items-center gap-3">
                <span class="text-2xl">🛡️</span>
                <div>
                    <h1 class="text-sm font-bold text-white tracking-wide">Mari Berbagi</h1>
                    <p class="text-[10px] text-slate-400 font-semibold tracking-wider uppercase">Sistem Pengelola v2.1.2</p>
                </div>
            </div>
            
            <nav class="flex-1 p-4 space-y-1.5">
                <a href="/admin" class="w-full flex items-center gap-3 px-4 py-2.5 text-xs font-medium rounded-xl hover:bg-slate-800 hover:text-white transition-all {{ Request::is('admin') ? 'bg-slate-800 text-white' : '' }}">📊 Dashboard Utama</a>
                <a href="/admin/donasi-dana" class="w-full flex items-center gap-3 px-4 py-2.5 text-xs font-medium rounded-xl hover:bg-slate-800 hover:text-white transition-all {{ Request::is('admin/donasi-dana') ? 'bg-slate-800 text-white' : '' }}">💰 Donasi Dana</a>
                <a href="/admin/donasi-barang" class="w-full flex items-center gap-3 px-4 py-2.5 text-xs font-medium rounded-xl hover:bg-slate-800 hover:text-white transition-all {{ Request::is('admin/donasi-barang') ? 'bg-slate-800 text-white' : '' }}">📦 Donasi Barang</a>
                <a href="/admin/feedback" class="w-full flex items-center gap-3 px-4 py-2.5 text-xs font-medium rounded-xl hover:bg-slate-800 hover:text-white transition-all {{ Request::is('admin/feedback') ? 'bg-slate-800 text-white' : '' }}">💬 Kolom Feedback</a>
                <a href="/admin/users" class="w-full flex items-center gap-3 px-4 py-2.5 text-xs font-medium rounded-xl hover:bg-slate-800 hover:text-white transition-all {{ Request::is('admin/users') ? 'bg-slate-800 text-white' : '' }}">👥 Manajemen User</a>
            </nav>
        </aside>

        {{-- CONTAINER KONTEN KANAN --}}
        <div class="flex-1 flex flex-col min-w-0">
            <header class="bg-white h-16 border-b border-slate-200 px-6 flex items-center justify-between">
                <h2 class="text-sm font-bold text-slate-800">Panel Kendali Admin</h2>
                <div class="flex items-center gap-2 text-xs font-bold text-slate-700">
                    <div class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center">A</div>
                    <span>Administrator</span>
                </div>
            </header>

            {{-- NOTIFIKASI SUKSES GLOBAL --}}
            @if(session('success'))
                <div class="mx-6 mt-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold rounded-xl">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <main class="flex-1 p-6 overflow-y-auto">
                @yield('admin-content')
            </main>
        </div>
    </div>
</body>
</html>