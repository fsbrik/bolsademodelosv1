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
                //['name' => 'Fotos', 'route' => ''],
                ['name' => 'Empresas', 'route' => 'empresas.index'],
                ['name' => 'Servicios', 'route' => 'servicios.index'],
            ];
        } elseif ($user->hasRole('modelo')) {
            $this->links = [
                ['name' => 'Perfil', 'route' => 'profile.show'],
                ['name' => 'Ficha técnica', 'route' => 'modelos.show', 'param' => $user->modelo->id],
                //['name' => 'Fotos', 'route' => ''],
                ['name' => 'Reservas', 'route' => 'pedidos.index'],
                ['name' => 'Estado', 'route' => 'modelos.cambiar_estado'],
            ];
        } elseif ($user->hasRole('empresa')) {

            $this->links = [
                ['name' => 'Perfil', 'route' => 'profile.show'],
                ['name' => 'Mis empresas', 'route' => 'empresas.index'],
                ['name' => 'Contrataciones', 'route' => 'modelos.index'],
                ['name' => 'Reservas', 'route' => 'pedidos.index'],
            ];
        }
    }

    public function render()
    {
        return view('livewire.navigation-menu-vertical');
    }
}
