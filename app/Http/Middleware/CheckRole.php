<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Si el usuario no está autenticado o su rol no coincide, lo redirigimos
        if (Auth::check() && Auth::user()->rol !== $role) {
            return redirect('/');
        }

        return $next($request);
    }
}
