<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthUserOrAdmin
{
   
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check() || Auth::guard('web')->check()) {
            return $next($request);
        }

        return redirect('/login'); 
    }
}