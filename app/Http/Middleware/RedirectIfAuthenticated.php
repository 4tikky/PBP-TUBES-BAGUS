<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                // Arahkan sesuai peran untuk menghindari 403 pada middleware role
                if ($user && $user->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                }

                if ($user && $user->role === 'user') {
                    return redirect()->route('buyer.dashboard');
                }

                // Fallback jika role tidak dikenali
                return redirect('/');
            }
        }

        return $next($request);
    }
}
