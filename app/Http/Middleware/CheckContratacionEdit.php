<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Contratacion;
use Illuminate\Support\Carbon;

class CheckContratacionEdit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        // Obtener el ID de la contratación de la URL
        $contratacionId = $request->route('contratacion');

        $contratacion = Contratacion::findOrFail($contratacionId);
        $modelosConfirmadas = $contratacion->confirmaciones->where('estado', 1)->count();
        if($modelosConfirmadas > 0 && Carbon::today()->gt(Carbon::parse($contratacion->fec_fin)))
        {
            abort(403, 'Acción no autorizada.');
        } 
        else
        {
            return $next($request);
        }  
        
    }
}
