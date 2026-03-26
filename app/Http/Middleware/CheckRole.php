<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Si no ha iniciado sesión, lo mandamos al login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Verificamos si el rol del usuario está dentro de los roles permitidos
        if (in_array(Auth::user()->rol, $roles)) {
            return $next($request); // ¡Pásale!
        }

        // 3. Si no tiene el rol, le mostramos un error de acceso denegado
        abort(403, 'Acceso denegado: No tienes el rol necesario para ver esta pantalla.');
    }
}