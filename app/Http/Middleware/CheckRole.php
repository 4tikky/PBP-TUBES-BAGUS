<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Jika pengguna tidak login ATAU perannya tidak sesuai
        if (!auth()->check() || auth()->user()->role !== $role) {
            // Tampilkan halaman error "Forbidden"
            abort(403);
        }

        return $next($request);
    }
}