<?php

use Livewire\Volt\Component;

new class extends Component {
    public $searchName, $searchTelefono, $searchEmail;

    public function updated($field)
    {
        if (in_array($field, ['searchName', 'searchTelefono', 'searchEmail'])) {
            $this->dispatch('actualizarBusquedaUsuario', searchName: $this->searchName, searchTelefono: $this->searchTelefono, searchEmail: $this->searchEmail);
        }
    }
}; ?>

<div class="border-base-content/25 w-full overflow-x-auto bg-gray-100 grid grid-cols-12 gap-2 mb-2 p-2">
    <x-field span=4>
        <label for="searchName">{{ __('Nombre / apellido') }}</label>
        <input id="searchName" type="text" wire:model.live.debounce.250ms="searchName" />
    </x-field>
    <x-field span=4>
        <label for="searchTelefono">{{ __('Teléfono') }}</label>
        <input id="searchTelefono" type="text" wire:model.live.debounce.250ms="searchTelefono" />
    </x-field>
    <x-field span=4>
        <label for="searchEmail">{{ __('Email') }}</label>
        <input id="searchEmail" type="text" wire:model.live.debounce.250ms="searchEmail" />
    </x-field>
</div>
