<?php

use App\Livewire\Forms\EmpresaForm;
use Livewire\Volt\Component;
use App\Models\Empresa;

new class extends Component {
    public EmpresaForm $empresa;
    public Empresa $empresaOriginal;
    public $empresaId;
    public $disabled; // para deshabilitar o no los campos del formulario dependiendo si la vista es create, show o edit
    public $hidden = [];

    public function mount($empresaId, $tipoDeRuta)
    {
        $this->empresaOriginal = Empresa::findOrFail($empresaId);
        $this->empresa->fill($this->empresaOriginal->toArray()); // Cargar los valores del modelo en el Form Object
        $this->empresaId = $empresaId;
        $this->mostrarBotones($tipoDeRuta); // mostrar botones dependiendo la ruta
        $this->habilitarCampos($tipoDeRuta); // habilitar campos del form dependiendo la ruta
    }

    // este método setea los botones en hidden o no dependiendo la ruta
    public function mostrarBotones($tipoDeRuta)
    {
        switch ($tipoDeRuta) {
            case 'edit':
                $this->hidden = ['', 'hidden', 'hidden', '', ''];
                break;
            case 'show':
                $this->hidden = ['hidden', '', '', 'hidden', ''];
                break;
        }
    }

    // este método setea los inputs del form en disable o no dependiendo la ruta
    public function habilitarCampos($tipoDeRuta)
    {
        switch ($tipoDeRuta) {
            case 'edit':
                $this->disabled = '';
                break;
            case 'show':
                $this->disabled = 'disabled';
                break;
        }
    }

    public function show()
    {
        $this->mostrarBotones('show');
        $this->habilitarCampos('show');
    }

    public function edit()
    {
        $this->mostrarBotones('edit');
        $this->habilitarCampos('edit');
    }

    public function destroy()
    {
        $this->empresaOriginal->delete();

        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $empresas = Empresa::query();
        } else {
            $empresas = Empresa::where('user_id', $user->id);
        }

        $empresas = $empresas->paginate(10);
        session()->flash('errorMessage', 'Se eliminó a la empresa ' . $this->empresaOriginal->nom_com);
        return redirect()->route('empresas.index', compact('empresas'));
    }

    public function update()
    {
        $this->validate();

        $this->empresaOriginal->update($this->empresa->all());
        $this->dispatch('mostrar-alerta', tipo: 'success', mensaje: 'Se actualizó a la empresa ' . $this->empresaOriginal->nom_com);
    }
}; ?>


<div class="campos-container">
    <!-- Id -->
    <x-field span=2>
        <h4>{{ __('Id de la empresa: ') }}</h4>
        <h4>{{ $this->empresaOriginal->id }}</h4>
    </x-field>

    <!-- Tipo -->
    <x-field span=2>
        <label for="tipo">{{ __('Tipo') }}</label>
        <select id="tipo" wire:model="empresa.tipo" {{ $disabled }} class="{{ $disabled }}">
            <option value="A">{{ __('A') }}</option>
            <option value="C">{{ __('C') }}</option>
        </select>
    </x-field>

    <!-- Cuit -->
    <x-field span=3>
        <label for="cuit">{{ __('CUIT') }}</label>
        <input id="cuit" wire:model="empresa.cuit" type="text" placeholder="00-00000000-0" {{ $disabled }}
            class="{{ $disabled }}" />
    </x-field>

    <!-- Rubro -->
    {{-- <x-field span=7 class="grid grid-cols-subgrid">
                <x-field span=3>
                    <label for="rubro">{{ __('Rubro') }}</label>
                    <input id="rubro" wire:model="empresa.rubro" type="text" />
                </x-field>
            </x-field> --}}
    <x-field span=4>
        <label for="rubro">{{ __('Rubro') }}</label>
        <input id="rubro" wire:model="empresa.rubro" type="text" {{ $disabled }}
            class="{{ $disabled }}" />
    </x-field>

    <!-- Nombre Comercial -->
    <x-field span=4 class="sm:row-start-2">
        <label for="nom_com">{{ __('Nombre Comercial') }}</label>
        <input id="nom_com" wire:model="empresa.nom_com" type="text" {{ $disabled }}
            class="{{ $disabled }}" />
    </x-field>

    <!-- Domicilio -->
    <x-field span=4>
        <label for="domicilio">{{ __('Domicilio') }}</label>
        <input id="domicilio" wire:model="empresa.domicilio" type="text" {{ $disabled }}
            class="{{ $disabled }}" />
    </x-field>

    <x-field span=12>
        <x-validation-errors></x-validation-errors>
        <div class="buttons-container">

            <x-cards.button-show :param="$empresaOriginal->id" :hidden="$hidden[0]" />
            <x-cards.button-edit :param="$empresaOriginal->id" :hidden="$hidden[1]" />
            <x-cards.button-delete :param="$empresaOriginal->id" :tipo="'a la empresa ' . $empresaOriginal->nom_com" :hidden="$hidden[2]" />
            <x-cards.button-update :param="$empresaOriginal->id" :hidden="$hidden[3]" />

            @can('empresas.index')
                <x-cards.button-a route="empresas.index">{{ __('Volver') }}</x-cards.button-a>
            @endcan
        </div>

    </x-field>
</div>
