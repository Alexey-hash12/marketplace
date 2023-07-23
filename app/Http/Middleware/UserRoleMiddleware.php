<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        if (!$request->user()) {
            abort(403, 'Нету доступа');
        }

        if (!in_array($request->user()->role, $guards)) {
            abort(403, 'Нету доступа');
        }

        return $next($request);
    }
}
