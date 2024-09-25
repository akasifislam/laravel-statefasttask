<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        // Check if the authenticated user's role matches the required role
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Redirect or show 403 Forbidden if the user is unauthorized
        abort(403, 'Unauthorized action.');
    }
}
