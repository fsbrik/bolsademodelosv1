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

        // Verificar si el usuario es una empresa o un admin
        if ($user->hasRole(['empresa', 'admin'])) {
            // Buscar el plan con los criterios especificados
            $plan = Pedido::where('id', $planId->id)
                ->whereHas('servicios', function ($query) {
                    $query->where('cat_ser', 'empresa')->where('sub_cat', 'planes');
                })
                ->when($user->hasRole('empresa'), function ($query) use ($user) {
                    // Filtrar por user_id solo si es una empresa
                    $query->where('user_id', $user->id);
                })
                ->where(function ($query) {
                    $query->where('habilita', 1)->orWhereNull('habilita');
                })
                ->first();

            // Verificar si el plan no existe
            if (!$plan) {
                return abort(404, 'Plan no encontrado.');
            }

            // Si el plan es válido, continuar con la solicitud
            return $next($request);
        }

        // Si el usuario no tiene los roles necesarios, denegar acceso
        return abort(403, 'No tienes permiso para acceder a esta página.');
    }
}
