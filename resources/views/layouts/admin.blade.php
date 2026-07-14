<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Admin') — Mari Berbagi</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-800">
    <div class="flex min-h-screen">
        
        {{-- SIDEBAR NAVIGASI PREMIUM (Tema Emerald Deep Slate) --}}
        <aside class="w-64 bg-slate-900 text-slate-300 shrink-0 hidden md:flex flex-col border-r border-slate-800 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl -mr-16 -mt-16 pointer-events-none"></div>
            
            <div class="p-5 border-b border-slate-800/80 flex items-center gap-3 relative">
                <div class="w-9 h-9 rounded-xl bg-emerald-800 flex items-center justify-center font-bold text-white shadow-md shadow-emerald-900/30 text-lg">
                    ✦
                </div>
                <div>
                    <h1 class="text-sm font-extrabold text-white tracking-wide">Mari Berbagi</h1>
                    <p class="text-[10px] text-emerald-400 font-bold tracking-wider uppercase">Sistem Pengelola v2.1.2</p>
                </div>
            </div>
            
            <nav class="flex-1 p-4 space-y-1.5 z-10">
                <a href="/admin" 
                   class="w-full flex items-center gap-3 px-4 py-3 text-xs font-bold rounded-xl transition-all group {{ Request::is('admin') ? 'bg-emerald-800 text-white shadow-md shadow-emerald-900/20' : 'hover:bg-slate-800/60 hover:text-white' }}">
                    <span class="text-sm transition-transform group-hover:scale-110">📊</span> 
                    Dashboard Utama
                </a>
                
                <a href="/admin/donasi-dana" 
                   class="w-full flex items-center gap-3 px-4 py-3 text-xs font-bold rounded-xl transition-all group {{ Request::is('admin/donasi-dana') ? 'bg-emerald-800 text-white shadow-md shadow-emerald-900/20' : 'hover:bg-slate-800/60 hover:text-white' }}">
                    <span class="text-sm transition-transform group-hover:scale-110">💳</span> 
                    Donasi Dana
                </a>
                
                <a href="/admin/donasi-barang" 
                   class="w-full flex items-center gap-3 px-4 py-3 text-xs font-bold rounded-xl transition-all group {{ Request::is('admin/donasi-barang') ? 'bg-emerald-800 text-white shadow-md shadow-emerald-900/20' : 'hover:bg-slate-800/60 hover:text-white' }}">
                    <span class="text-sm transition-transform group-hover:scale-110">📦</span> 
                    Donasi Barang
                </a>
                
                <a href="/admin/feedback" 
                   class="w-full flex items-center gap-3 px-4 py-3 text-xs font-bold rounded-xl transition-all group {{ Request::is('admin/feedback') ? 'bg-emerald-800 text-white shadow-md shadow-emerald-900/20' : 'hover:bg-slate-800/60 hover:text-white' }}">
                    <span class="text-sm transition-transform group-hover:scale-110">💬</span> 
                    Kolom Feedback
                </a>
                
                <a href="/admin/users" 
                   class="w-full flex items-center gap-3 px-4 py-3 text-xs font-bold rounded-xl transition-all group {{ Request::is('admin/users') ? 'bg-emerald-800 text-white shadow-md shadow-emerald-900/20' : 'hover:bg-slate-800/60 hover:text-white' }}">
                    <span class="text-sm transition-transform group-hover:scale-110">👥</span> 
                    Manajemen User
                </a>
            </nav>

            <div class="p-4 border-t border-slate-800/80 bg-slate-950/20">
                <a href="/" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 text-[11px] font-bold text-slate-400 bg-slate-800/40 border border-slate-800 hover:border-slate-700 rounded-xl hover:text-white transition-all">
                    🏠 Lihat Halaman Utama
                </a>
            </div>
        </aside>

        {{-- CONTAINER KONTEN KANAN --}}
        <div class="flex-1 flex flex-col min-w-0">
            <header class="bg-white h-16 border-b border-slate-200/80 px-6 flex items-center justify-between shadow-sm shadow-slate-100/40">
                <div class="flex items-center gap-2">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Sistem Kendali Kontrol</span>
                </div>
                
                <div class="flex items-center gap-2.5 text-xs font-bold text-slate-700 bg-slate-50 border border-slate-200/60 px-3 py-1.5 rounded-xl shadow-sm">
                    <div class="w-6 h-6 rounded-lg bg-emerald-800 text-white flex items-center justify-center text-[10px] font-extrabold shadow-sm shadow-emerald-800/20">
                        A
                    </div>
                    <span class="text-slate-800">Administrator</span>
                </div>
            </header>

            {{-- NOTIFIKASI SUKSES GLOBAL (Kita percantik dengan gaya Emerald Alert) --}}
            @if(session('global_success'))
                <div class="mx-6 mt-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-800 text-xs font-semibold rounded-2xl shadow-sm flex items-center gap-2">
                    <span>✨</span>
                    <p>{{ session('global_success') }}</p>
                </div>
            @endif

            {{-- TEMPAT KONTEN DINAMIS UTAMA --}}
            <main class="flex-1 p-6 overflow-y-auto">
                @yield('admin-content')
            </main>
        </div>
    </div>
</body>
</html>