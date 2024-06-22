<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfUserHasEmpresa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->hasRole('empresa') && $user->empresa) {
            // Redirigir con un mensaje de error si el usuario ya tiene una empresa asociada
            return redirect()->route('empresas.show', $user->empresa->id)->with('error', 'Ya tienes una empresa asociada y no puedes crear otra.');
        }

        return $next($request);
    }
}

