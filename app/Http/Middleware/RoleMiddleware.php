<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        $user = $request->user();
        $roles = array();

        if( strpos($role, '|' ) ) {
            $roles = explode("|", $role );
        } else {
            array_push( $roles, $role );
        }

        if (!$user || ! in_array( $user->role->role, $roles ) ) {
            redirect('/');
        }
        return $next($request);
    }
}
