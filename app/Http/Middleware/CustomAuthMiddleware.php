<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CustomAuthMiddleware
{
    public function handle($request, Closure $next)
    {

        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'Unauthorized access. Please log in.');
        }
        return $next($request);
    }
}
