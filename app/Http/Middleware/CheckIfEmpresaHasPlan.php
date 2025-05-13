<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckIfEmpresaHasPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user->hasRole('empresa')) {
            // Armamos la relacion desde el user hasta obtener los planes
            $query = $user->pedidos()->whereHas('servicios', fn($q) =>
                $q->where('cat_ser', 'empresa')->where('sub_cat', 'planes'));

            // si tiene un plan habilitado (abonado) o si tiene un plan seleccionado pero no abonado
            $planExistente = $query->where(function ($q) {
                    $q->where('habilita', 1)->orWhereNull('habilita'); 
                })->first();
            
            if($planExistente)
            {
                
                if ($planExistente->user_id == $user->id) {
                    // si ya tiene un plan vigente, no se le permite contratar otro plan. Es por eso que se lo redirecciona.
                    return redirect()->route('planes.index');
                } else {
                    // tenemos que filtrar otros usuarios que no sean el autenticado
                    return abort(403, 'No tenés permiso para realizar esta acción.');
                }
            }

            else

            {
                return $next($request); // Permitir contratar un plan (ya que no va a duplicar)
            }

        }

        elseif($user->hasRole('admin'))
        {
            return $next($request);
        }

        else
        {
            // tenemos que filtrar otros usuarios que no sean el autenticado
            return abort(403, 'No tenés permiso para realizar esta acción.');
        }
    }
}
