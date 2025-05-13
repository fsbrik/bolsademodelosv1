<?php

use App\Livewire\Forms\EmpresaForm;
use Livewire\Volt\Component;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

new class extends Component {
    public EmpresaForm $empresa;
    public User $user;

    #[On('idUsuarioSeleccionado')]
    public function asignarIdUsuario($idUsuarioSeleccionado)
    {
        $this->empresa->user_id = $idUsuarioSeleccionado; // pasa el valor del usuario seleccionado por el componente seleccionador-de-usuario por el admin
    }

    // este método asigna el id del usuario autenticado como empresa (es decir que no es el admin)
    public function verificarIdUsuarioEmpresa()
    {
        if (Auth::user()->hasRole('empresa')) {
            $this->empresa->user_id = Auth::user()->id;
        }
    }

    public function store()
    {
        $this->validate();

        $this->verificarIdUsuarioEmpresa(); // si el usuario es admin el user_id proviene de asignarIdUsuario. Si es empresa, le asigna el id del usuario a user_id

        $empresaOriginal = Empresa::create($this->empresa->all());
        return redirect()->route('empresas.show', $empresaOriginal->id);
    }
}; ?>


<div class="campos-container">

    <!-- Tipo -->
    <x-field span=2>
        <label for="tipo">{{ __('Tipo') }}</label>
        <select id="tipo" wire:model="empresa.tipo">
            <option value="A">{{ __('A') }}</option>
            <option value="C">{{ __('C') }}</option>
        </select>
    </x-field>

    <!-- Cuit -->
    <x-field span=3>
        <label for="cuit">{{ __('CUIT') }}</label>
        <input id="cuit" wire:model="empresa.cuit" type="text" placeholder="00-00000000-0" />
    </x-field>

    <!-- Rubro -->
    <x-field span=4>
        <label for="rubro">{{ __('Rubro') }}</label>
        <input id="rubro" wire:model="empresa.rubro" type="text" />
    </x-field>

    <!-- Nombre Comercial -->
    <x-field span=4 class="sm:row-start-2">
        <label for="nom_com">{{ __('Nombre Comercial') }}</label>
        <input id="nom_com" wire:model="empresa.nom_com" type="text" />
    </x-field>

    <!-- Domicilio -->
    <x-field span=4>
        <label for="domicilio">{{ __('Domicilio') }}</label>
        <input id="domicilio" wire:model="empresa.domicilio" type="text" />
    </x-field>

    <x-field span=12>
        <x-validation-errors></x-validation-errors>
        <div class="buttons-container">
            <x-cards.button-store>{{ __('Guardar empresa') }}</x-cards.button-store>

            @can('empresas.index')
                <x-cards.button-a route="empresas.index">{{ __('Volver') }}</x-cards.button-a>
            @endcan
        </div>

    </x-field>
</div>
