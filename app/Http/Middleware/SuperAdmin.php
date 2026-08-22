<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user || $user->role !== 0) {
            abort(403, 'Akses ditolak. Hanya Super Admin yang diizinkan.');
        }

        return $next($request);
    }
}