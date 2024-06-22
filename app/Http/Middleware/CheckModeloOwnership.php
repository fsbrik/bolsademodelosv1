<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Modelo;

class CheckModeloOwnership
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
            abort(404, 'Modelo no encontrado.');
        }

        // Verifica la propiedad del modelo
        if (Auth::user()->id !== $model->user_id && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);

    }
}
