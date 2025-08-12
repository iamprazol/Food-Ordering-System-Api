<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class SuAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->role->role == 'admin' || Auth::user()->role->role == 'manager')) {
            return $next($request);
        } elseif (Auth::check() && Auth::user()->role->role == 'delivery'){
            return redirect('/delivery');
        } else {
            return redirect('/customer');
        }
    }
}
