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

        $requestPlan = $request->route('plan'); //intercepto modelo del request

        if ($user->hasRole('empresa')) {
            // si tiene un plan habilitado (abonado)
            $userConPlanAbonado = $user->pedidos()
                ->whereHas(
                    'servicios',
                    fn($q) =>
                    $q->where('cat_ser', 'empresa')->where('sub_cat', 'planes')
                )
                ->where('habilita', 1)
                ->first();

            // si tiene un plan seleccionado pero no abonado
            $userConplanSeleccionado = $user->pedidos()
                ->whereHas(
                    'servicios',
                    fn($q) =>
                    $q->where('cat_ser', 'empresa')->where('sub_cat', 'planes')
                )
                ->whereNull('habilita')
                ->first();

            // si tiene un plan abonado, ya no puede cambiarlo
            if ($userConPlanAbonado) {
                return abort(403, 'Ya tenés un plan abonado');
            }


            if ($userConplanSeleccionado) {
                if ($userConplanSeleccionado->id == $requestPlan->id) {
                    // se le da permiso para cambiar de plan
                    return $next($request);
                } else {
                    // tenemos que filtrar otros usuarios que no sean el autenticado
                    return abort(403, 'No tenés permiso para realizar esta acción.');
                }
            }
        } elseif ($user->hasRole('admin')) {
             return $next($request);
        } else {
            // tenemos que filtrar otros usuarios que no sean el autenticado
            return abort(403, 'No tenés permiso para realizar esta acción.');
        }

        return $next($request);
    }
}

















        /* // Verificar si el usuario es admin o empresa
        if (! $user->hasRole(['admin', 'empresa'])) {
            return abort(403, 'No tienes permiso para acceder a esta página.');
        }

        // Armar la query base del plan
        $planQuery = Pedido::where('id', $requestPlan->id)
            ->whereHas('servicios', fn($q) =>
            $q->where('cat_ser', 'empresa')->where('sub_cat', 'planes'))
            ->where(function ($q) {
                $q->where('habilita', 1)->orWhereNull('habilita');
            });

        // Si es empresa, verificar propiedad del plan
        if ($user->hasRole('empresa')) {
            $plan = $planQuery->first();

            if (! $plan) {
                return abort(404, 'Plan no encontrado.');
            }

            if ($plan->user_id !== $user->id) {
                return abort(403, 'Permiso denegado.');
            }
        } else {
            // Admin: solo verificamos que el plan exista
            $plan = $planQuery->first();

            if (! $plan) {
                return abort(404, 'Plan no encontrado.');
            }
        } */
        /* // Buscar el plan con los criterios especificados
        $plan = Pedido::where('id', $requestPlan->id)
            ->whereHas('servicios', fn($q) =>
            $q->where('cat_ser', 'empresa')->where('sub_cat', 'planes'))
            ->when($user->hasRole('empresa'), function ($query) use ($user) {
                // Filtrar por user_id solo si es una empresa
                $query->where('user_id', $user->id);
            })
            ->where(function ($q) {
                $q->where('habilita', 1)->orWhereNull('habilita');
            });

        // Verificar si el plan no existe
        if (!$plan) {
            return abort(404, 'Plan no encontrado.');
        }

        // Si el plan es válido, continuar con la solicitud
        return $next($request); */
