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

        // 2. Cek apakah role user sesuai dengan role yang diizinkan
        if ($roles !== [] && ! in_array(Auth::user()->role, $roles, true)) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk halaman ini.');
        }

        return $next($request);
    }
}