<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;

class CheckPlanOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $planId = $request->route('pedido');

        // verificar el plan
        $plan = Pedido::where('id', $planId->id)
            ->where('user_id', $user->id)
            ->whereHas('servicios', function($query) {
                $query->where('cat_ser', 'empresa')->where('sub_cat', 'planes');
            })
            ->where(function($query) {
                $query->where('habilita', 1)->orWhereNull('habilita');
            })
            ->first();

        // Verificar si el plan no existe y si el usuario es admin o empresa con plan válido
        if (!$plan) {
            return abort(404, 'Plan no encontrado.');
        }

        if ($user->hasRole('empresa') || $user->hasRole('admin')) {
            return $next($request);
        }

        return abort(403, 'No tienes permiso para acceder a esta página.');
    }
}
