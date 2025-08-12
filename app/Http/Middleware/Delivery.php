<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Delivery
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
        if (Auth::check() && Auth::user()->role->role == 'delivery'){
            return $next($request);
        } elseif (Auth::check() && (Auth::user()->role->role == 'admin' || Auth::user()->role->role == 'manager')){
            return redirect('/admin');
        } else {
            return redirect('/customer');
        }
    }
}
