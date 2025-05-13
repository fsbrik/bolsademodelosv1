<?php

use Livewire\Volt\Component;

new class extends Component {
    public $searchTerm, $sort_by = 'habilita', $sortDirection = 'asc';

    public function updatedSearchTerm()
    {
        $this->dispatch('actualizarBusqueda', searchTerm: $this->searchTerm);
    }
    
    public function sortBy($field)
    {
        $this->resetPage();
        if ($this->sort_by === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort_by = $field;
            $this->sortDirection = 'asc';
        }
    }

}; ?>

<div>
    <x-input wire:model.live.debounce.250ms="searchTerm" type="text"
                        placeholder="Buscar..." class="mb-4" />
</div>
