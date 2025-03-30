<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Modelo;

class CheckModeloOwnershipShow
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
        $model = $request->route('modelo');

         // Asegúrate de que es una instancia de Modelo
         if (!$model instanceof Modelo) {
            abort(404, 'Modelo no encontrada.');
        }

        // Verifica la propiedad del modelo
        if (Auth::user()->id !== $model->user_id && Auth::user()->hasRole('modelo')) {
            abort(403, 'Acción no autorizada.');
        }

        return $next($request);

    }
}
