<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contratacion;

class CheckContratacionModeloOwnership
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
        $contratacionId = $request->route('contratacion');
        $contratacion = Contratacion::find($contratacionId);

        // verifica si existe la contratación
        if (!$contratacion) {
        abort(404, 'Contratación no encontrada.');
        }

        // Verifica la propiedad de la modelos en dicha contratación
        // Obtener el modelo relacionado a la contratación que corresponde al usuario autenticado
        $modeloRelacionado = $contratacion->modelos()->where('modelo_id', Auth::user()->modelo->id)->first();

        // Verifica si el modelo está relacionado con la contratación
        if (!$modeloRelacionado || Auth::user()->id !== $modeloRelacionado->user->id) {
            // Si el usuario no es un administrador y no es el modelo relacionado, deniega acceso
            if (!Auth::user()->hasRole('admin')) {
                abort(403, 'Acción no autorizada.');
            }
        }


        return $next($request);

    }
}
