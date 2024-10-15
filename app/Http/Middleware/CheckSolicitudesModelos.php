<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckSolicitudesModelos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = Auth::user();

        // Verificar si el usuario tiene el permiso modelos.solicitudes_modelo
        if($user->can('modelos.solicitudes_modelos'))
        {
            return $next($request);
        }

        abort(403, 'No tienes permiso para acceder a esta página.');
        
    }
}
