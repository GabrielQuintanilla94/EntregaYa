<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // 1. Verificamos si el usuario tiene el rol que pide la ruta
        if (Auth::check() && Auth::user()->rol === $role) {
            return $next($request); // Lo deja pasar
        }

        // 2. Si no tiene el rol, lo regresamos a su zona permitida
        if (Auth::check() && Auth::user()->rol === 'conductor') {
            return redirect('/mis-entregas');
        }

        // 3. Si es un admin intentando entrar a zona de conductores
        return redirect('/dashboard');
    }
}