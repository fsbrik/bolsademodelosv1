<?php

use Livewire\Volt\Component;

new class extends Component {
    public $searchComercial, $searchDomicilio, $searchCuit;

    public function updated($field)
    {
        if(in_array($field, ['searchComercial', 'searchDomicilio', 'searchCuit']))
        {
            $this->dispatch('actualizarBusquedaEmpresas', searchComercial: $this->searchComercial, searchDomicilio:$this->searchDomicilio, searchCuit:$this->searchCuit);
        }
    }
}; ?>

<div class="border-base-content/25 w-full overflow-x-auto bg-gray-100 grid grid-cols-12 gap-2 mb-2 p-2">
    <x-field span=4>
        <label for="searchComercial">{{ __('Nombre comercial') }}</label>
        <input id="searchComercial" type="text" wire:model.live.debounce.250ms="searchComercial" />
    </x-field>
    <x-field span=4>
        <label for="searchDomicilio">{{ __('Domicilio') }}</label>
        <input id="searchDomicilio" type="text" wire:model.live.debounce.250ms="searchDomicilio" />
    </x-field>
    <x-field span=4>
        <label for="searchCuit">{{ __('Cuit') }}</label>
        <input id="searchCuit" type="text" wire:model.live.debounce.250ms="searchCuit" />
    </x-field>
</div>
