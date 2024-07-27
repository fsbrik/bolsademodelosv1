<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;

class CheckPedidoOwnership
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
        $pedido = $request->route('pedido');

        // Asegúrate de que es una instancia de Pedido
        if (!$pedido instanceof Pedido) {
            abort(404, 'Pedido no encontrado.');
        }

        // Verifica la propiedad del pedido
        if (Auth::user()->id !== $pedido->user_id && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
