<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        $user = $request->user();

        if (!$user || $user->role->role !== $role) {
            abort(403, 'Forbidden');
        }
        return $next($request);
    }
}
