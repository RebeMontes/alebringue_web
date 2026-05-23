<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserType
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $userType): Response
    {
        if (!$request->user() || $request->user()->user_type !== $userType) {
            abort(403, 'Acceso no autorizado.');
        }

        return $next($request);
    }
}
