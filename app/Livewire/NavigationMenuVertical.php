<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class NavigationMenuVertical extends Component
{
    public $links = [];

    public function mount()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $this->links = [
                ['name' => 'Solicitudes', 'route' => 'solicitudes_modelos'],
                ['name' => 'Reservas', 'route' => 'pedidos.index'],
                ['name' => 'Modelos', 'route' => 'modelos.index'],
                ['name' => 'Empresas', 'route' => 'empresas.index'],
                ['name' => 'Servicios', 'route' => 'servicios.index'],
            ];
        } elseif ($user->hasRole('modelo')) {
            if (!$user->modelo) {
                $this->links = [
                    ['name' => 'Perfil', 'route' => 'profile.show'],
                    ['name' => 'Ficha técnica', 'route' => 'modelos.create'],
                ];
            } else {
                $this->links = [
                    ['name' => 'Perfil', 'route' => 'profile.show'],
                    ['name' => 'Ficha técnica', 'route' => 'modelos.show', 'param' => $user->modelo->id],
                    ['name' => 'Reservas', 'route' => 'pedidos.index'],
                    ['name' => 'Estado', 'route' => 'modelos.cambiar_estado'],
                ];
            }
        } elseif ($user->hasRole('empresa')) {
            if (!$user->empresas()->count()) {
                $this->links = [
                    ['name' => 'Perfil', 'route' => 'profile.show'],
                    ['name' => 'Inscribir empresa', 'route' => 'empresas.create'],
                ];
            } else {
                $this->links = [
                    ['name' => 'Perfil', 'route' => 'profile.show'],
                    ['name' => 'Mis empresas', 'route' => 'empresas.index'],
                    ['name' => 'Planes', 'route' => 'empresas.planes'],
                    ['name' => 'Modelos', 'route' => 'modelos.index'],
                    ['name' => 'Contrataciones', 'route' => 'empresas.contrataciones'],
                    ['name' => 'Reservas', 'route' => 'pedidos.index'],
                ];
            }
        }
    }

    public function render()
    {
        return view('livewire.navigation-menu-vertical', [
            'isModeloRouteActive' => request()->is('modelos*'),
            'isEmpresaRouteActive' => request()->is('empresas*'),
        ]);
    }
}

