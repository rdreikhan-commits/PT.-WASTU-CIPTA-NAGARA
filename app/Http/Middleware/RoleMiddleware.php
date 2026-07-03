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
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        if ($role === 'admin' && !$user->isAdmin()) {
            abort(403, 'Unauthorized access to admin area.');
        }

        if ($role === 'client' && !$user->isClient()) {
            abort(403, 'Unauthorized access to client area.');
        }

        return $next($request);
    }
}
