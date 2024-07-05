<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Modelo;

class NavigationMenuVertical extends Component
{
    public $links = [];

    public function mount()
    {
        $user = Auth::user();
        
        if ($user->hasRole('admin')) {
            $this->links = [
                ['name' => 'Solicitudes', 'route' => 'solicitudes-modelos'],
                ['name' => 'Contrataciones', 'route' => 'empresas/contrataciones'],
                ['name' => 'Modelos', 'route' => route('modelos.index')],
                ['name' => 'Empresas', 'route' => route('empresas.index')],
                ['name' => 'Servicios', 'route' => route('servicios.index')],
            ];
        } elseif ($user->hasRole('modelo')) {
            //$modeloId = Modelo::findOrFail($user->modelo->user_id);  
            $this->links = [
                ['name' => 'Perfil', 'route' => route('profile.show')],
                ['name' => 'Datos adicionales', 'route' => route('modelos.show', $user->modelo->id)],
                ['name' => 'Servicios', 'route' => 'servicios/modelos/servicios'],
                ['name' => 'Estado', 'route' => 'modelos/estado'],
            ];
        } elseif ($user->hasRole('empresa')) {
            $this->links = [
                ['name' => 'Perfil', 'route' => route('profile.show')],
                ['name' => 'Datos adicionales', 'route' => route('empresas.show', $user->id)],
                ['name' => 'Servicios', 'route' => 'servicios/empresas/servicios'],
            ];
        }
    }

    public function render()
    {
        return view('livewire.navigation-menu-vertical');
    }
}
