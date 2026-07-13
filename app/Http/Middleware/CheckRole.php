<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // 1. Cek apakah user sudah login, jika belum arahkan ke halaman login
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        // 2. TEMPORARY BYPASS (KHUSUS FRONTEND TESTING):
        // Jika yang login adalah akun dengan email 'admin@mail.com', langsung izinkan masuk tanpa cek kolom database.
        if (Auth::user()->email === 'admin@mail.com') {
            return $next($request);
        }

        // 3. Pengecekan Asli Backend (Akan aktif untuk akun selain admin@mail.com)
        if ($roles !== [] && ! in_array(Auth::user()->role, $roles, true)) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk halaman ini.');
        }

        return $next($request);
    }
}