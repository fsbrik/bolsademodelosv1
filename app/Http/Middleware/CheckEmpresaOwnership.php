<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Empresa;

class CheckEmpresaOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $empresa = $request->route('empresa');

        //dd(Auth::user()->hasRole('admin'));
         // Asegúrate de que es una instancia de empresa
         if (!$empresa instanceof Empresa) {
            abort(404, 'Empresa no encontrada.');
        }

        // Verifica la propiedad de la empresa
        if (Auth::user()->id !== $empresa->user_id && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);

    }
}
