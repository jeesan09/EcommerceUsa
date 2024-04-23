<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthUserOrAdmin
{
   
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check() || Auth::guard('web')->check()) {


            $user = Auth::user();

            if ($user && $user->status === 0) {

                // If user status is 0, log them out and redirect to login
                Auth::logout();
                return redirect('/login')->with('warning', 'Your account is not active yet.');
            }

               
            return $next($request);
           

        }

        return redirect('/login'); 
    }
}