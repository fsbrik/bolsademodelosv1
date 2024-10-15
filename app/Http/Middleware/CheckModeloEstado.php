<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckModeloEstado
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Verificar si el usuario tiene el permiso modelos.ver_estado
        if ($user->can('modelos.ver_estado')) {
            return $next($request);
        }

        // Si el usuario no tiene permiso, redirigir con un mensaje de error
        abort(403, 'No tienes permiso para acceder a esta página.');
    }
}
