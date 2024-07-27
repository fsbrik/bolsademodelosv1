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
                ['name' => 'Solicitudes', 'route' => 'solicitudes-modelos'],
                ['name' => 'Pedidos', 'route' => route('pedidos.index')],
                ['name' => 'Modelos', 'route' => route('modelos.index')],
                ['name' => 'Empresas', 'route' => route('empresas.index')],
                ['name' => 'Servicios', 'route' => route('servicios.index')],
            ];
        } elseif ($user->hasRole('modelo')) {
            $this->links = [
                ['name' => 'Perfil', 'route' => route('profile.show')],
                ['name' => 'Ficha técnica', 'route' => route('modelos.show', $user->modelo->id)],
                ['name' => 'Fotos', 'route' => ''],
                ['name' => 'Reservas', 'route' => route('pedidos.index')],
                ['name' => 'Estado', 'route' => route('modelos.cambiar_estado')],
            ];
        } elseif ($user->hasRole('empresa')) {
            $this->links = [
                ['name' => 'Perfil', 'route' => route('profile.show')],
                ['name' => 'Datos adicionales', 'route' => route('empresas.show', $user->id)],
                ['name' => 'Pedidos', 'route' => route('pedidos.create')],
            ];
        }
    }

    public function render()
    {
        return view('livewire.navigation-menu-vertical');
    }
}
