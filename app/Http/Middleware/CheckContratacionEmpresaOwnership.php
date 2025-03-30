<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contratacion;

class CheckContratacionEmpresaOwnership
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
        if(!$contratacion){
            abort(404, 'Contratación no encontrada.');
        }

        // Verifica la propiedad de la empresa de dicha contratación
        if (Auth::user()->id !== $contratacion->empresa->user->id && !Auth::user()->hasRole('admin')) {
            abort(403, 'Acción no autorizada.');
        }

        return $next($request);

    }
}
