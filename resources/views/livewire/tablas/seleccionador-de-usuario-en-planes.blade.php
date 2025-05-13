<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Pedido;
use Livewire\Attributes\On;

new class extends Component {
    use WithPagination;

    public $searchName, $searchEmpresa, $user;

    public function updatedSearchName()
    {
        if ($this->searchName) {
            // asigno el usuario encontrado
            $this->user = User::whereHas('roles', fn($query) => $query->where('name', 'empresa'))->where('name', 'like', '%' . $this->searchName . '%')->first();
            //en caso que el usuario no sea null
            if($this->user)
            {
                $this->dispatch('usuarioSeleccionado', userId: $this->user->id);
            }
        } else {
            $this->reset('user');
        }
        $this->reset('searchEmpresa');
    }

    public function updatedSearchEmpresa()
    {
        if ($this->searchEmpresa) {
            $this->user = User::whereHas('empresas', fn($query) => $query->where('nom_com', 'like', '%' . $this->searchEmpresa . '%'))->first();
            
            if($this->user)
            {
            $this->dispatch('usuarioSeleccionado', userId: $this->user->id);
            }

        } else {
            $this->reset('user');
        }
        $this->reset('searchName');
    }

    public function with(): array
    {
        return [
            'user' => $this->user,
        ];
    }
}; ?>
<div class="border-base-content/25 w-full overflow-x-auto bg-gray-100 grid grid-cols-12 gap-2 mb-4 p-2">
    <x-field span=4>
        <label for="searchName">{{ __('Nombre / apellido') }}</label>
        <input id="searchName" type="text" wire:model.live.debounce.250ms="searchName" />
    </x-field>
    <x-field span=4>
        <label for="searchEmpresa">{{ __('Empresa') }}</label>
        <input id="searchEmpresa" type="text" wire:model.live.debounce.250ms="searchEmpresa" />
    </x-field>
    @if ($user)
        <x-field span=4 class="row-start-2">
            <label class="p-1 rounded-md bg-green-400">
                {{ __('usuario seleccionado: ' . $user->name) }}
            </label>
        </x-field>
    @else
        <x-field span=4 class="row-start-2">
            <label class="p-1 rounded-md bg-red-400">
                {{ __('usuario no encontrado / no seleccionado') }}
            </label>
        </x-field>
    @endif



</div>
