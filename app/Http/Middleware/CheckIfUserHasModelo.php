<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfUserHasModelo
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

        if ($user && $user->hasRole('modelo') && $user->modelo) {
            // Redirigir con un mensaje de error si el usuario ya tiene un modelo asociado
            return redirect()->route('modelos.show', $user->modelo->id)->with('error', 'Ya tienes un modelo asociado y no puedes crear otro.');
        }

        return $next($request);
    }
}

