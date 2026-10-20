<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()) {
            return redirect()->route('login')->with('warning', 'Silakan login terlebih dahulu untuk mengakses halaman admin.');
        }

        if (! $request->user()->isAdmin()) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman admin.');
        }

        return $next($request);
    }
}
