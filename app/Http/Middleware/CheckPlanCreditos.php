<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;

class CheckPlanCreditos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $planHabilitado = Pedido::where('user_id', $user->id)->whereHas('servicios', function($query){
            $query->where('cat_ser', 'empresa')->where('sub_cat', 'planes');
            })->where('habilita', 1)->first();
        $creditos = $planHabilitado->creditos ?? null;

        if (!$planHabilitado) {
            return to_route('planes.index')->with('error', 'Contratá un plan antes de crear o editar una contratación');
        }
        
        if (!$creditos) {
            return to_route('empresas.contrataciones.index')->with('error', 'No te quedan créditos disponibles en el plan');
        }
        
        return $next($request);
        
    }
}
