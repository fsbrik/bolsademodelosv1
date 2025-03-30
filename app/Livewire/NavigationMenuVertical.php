<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class NavigationMenuVertical extends Component
{
    public $links = [];

    /* public function mount()
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
                    ['name' => 'Contrataciones', 'route' => 'modelos.contrataciones.index'],
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
                    ['name' => 'Contrataciones', 'route' => 'empresas.contrataciones.index'],
                    ['name' => 'Reservas', 'route' => 'pedidos.index'],
                ];
            }
        }
    }

    public function render()
    {
        return view('livewire.navigation-menu-vertical', [
            'isModeloRouteActive' => request()->is('modelos.index') || request()->is('modelos.show') || request()->is('modelos.edit'),
            'isEmpresaRouteActive' => request()->is('empresas*'),
            'isContratacionesModeloRouteActive' => request()->is('contrataciones.modelos*'),
            'isContratacionesEmpresaRouteActive' => request()->is('contrataciones.empresas*'),
        ]);
    } */

    public function mount()
{
    $user = Auth::user();

    if ($user->hasRole('admin')) {
        $this->links = [
            [
                'name' => 'Solicitudes', 
                'route' => route('solicitudes_modelos'), 
                'isActive' => request()->routeIs('solicitudes_modelos')
            ],
            [
                'name' => 'Reservas', 
                'route' => route('pedidos.index'), 
                'isActive' => request()->routeIs('pedidos.index')
            ],
            [
                'name' => 'Planes y créditos', 
                'route' => route('planes.index'), 
                'isActive' => request()->routeIs('planes.index')
            ],
            [
                'name' => 'Contrataciones', 
                'route' => route('modelos.contrataciones.index'), 
                'isActive' => request()->routeIs('modelos.contrataciones.index')
            ],
            [
                'name' => 'Usuarios', 
                'route' => route('users.index'), 
                'isActive' => request()->routeIs('users.index')
            ],
            [
                'name' => 'Modelos', 
                'route' => route('modelos.index'), 
                'isActive' => request()->routeIs('modelos.index')
            ],
            [
                'name' => 'Empresas', 
                'route' => route('empresas.index'), 
                'isActive' => request()->routeIs('empresas.index')
            ],
            [
                'name' => 'Servicios', 
                'route' => route('servicios.index'), 
                'isActive' => request()->routeIs('servicios.index')
            ],
        ];
    } elseif ($user->hasRole('modelo')) {
        if (!$user->modelo) {
            $this->links = [
                [
                    'name' => 'Perfil', 
                    'route' => route('profile.show'), 
                    'isActive' => request()->routeIs('profile.show')
                ],
                [
                    'name' => 'Ficha técnica', 
                    'route' => route('modelos.create'), 
                    'isActive' => request()->routeIs('modelos.create')
                ],
            ];
        } else {
            $this->links = [
                [
                    'name' => 'Perfil', 
                    'route' => route('profile.show'), 
                    'isActive' => request()->routeIs('profile.show')
                ],
                [
                    'name' => 'Ficha técnica', 
                    'route' => route('modelos.show', $user->modelo->id), 
                    'isActive' => request()->routeIs('modelos.show')
                ],
                [
                    'name' => 'Contrataciones', 
                    'route' => route('modelos.contrataciones.index'), 
                    'isActive' => request()->routeIs('modelos.contrataciones.index')
                ],
                [
                    'name' => 'Reservas', 
                    'route' => route('pedidos.index'), 
                    'isActive' => request()->routeIs('pedidos.index')
                ],
                [
                    'name' => 'Estado', 
                    'route' => route('modelos.cambiar_estado'), 
                    'isActive' => request()->routeIs('modelos.cambiar_estado')
                ],
            ];
        }
    } elseif ($user->hasRole('empresa')) {
        if (!$user->empresas()->count()) {
            $this->links = [
                [
                    'name' => 'Perfil', 
                    'route' => route('profile.show'), 
                    'isActive' => request()->routeIs('profile.show')
                ],
                [
                    'name' => 'Inscribir empresa', 
                    'route' => route('empresas.create'), 
                    'isActive' => request()->routeIs('empresas.create')
                ],
            ];
        } else {
            $this->links = [
                [
                    'name' => 'Perfil', 
                    'route' => route('profile.show'), 
                    'isActive' => request()->routeIs('profile.show')
                ],
                [
                    'name' => 'Mis empresas', 
                    'route' => route('empresas.index'), 
                    'isActive' => request()->routeIs('empresas.index')
                ],
                [
                    'name' => 'Planes', 
                    'route' => route('planes.create'), 
                    'isActive' => request()->routeIs('planes.create')
                ],
                [
                    'name' => 'Modelos', 
                    'route' => route('modelos.index'), 
                    'isActive' => request()->routeIs('modelos.index')
                ],
                [
                    'name' => 'Contrataciones', 
                    'route' => route('empresas.contrataciones.index'), 
                    'isActive' => request()->routeIs('empresas.contrataciones.index')
                ],
                [
                    'name' => 'Reservas', 
                    'route' => route('pedidos.index'), 
                    'isActive' => request()->routeIs('pedidos.index')
                ],
            ];
        }
    }
}


public function render()
    {
        return view('livewire.navigation-menu-vertical');
    }

}