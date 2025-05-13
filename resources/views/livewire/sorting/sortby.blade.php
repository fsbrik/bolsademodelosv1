<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Reactive;

new class extends Component
{
    public string $field;
    public string $label;

    #[Reactive]
    public string $sort_by;

    #[Reactive]
    public string $sortDirection;

    public function sortBy()
    {
        $sortDirection = $this->sort_by === $this->field && $this->sortDirection === 'asc'
            ? 'desc'
            : 'asc';

        $this->dispatch('sortBy', sort_by: $this->field, sortDirection: $sortDirection);
    }
};
?>

<button wire:click="sortBy" class="flex items-center">
    {{ $label }}
    @if ($sort_by === $field)
        @if ($sortDirection === 'asc')
            <span class="ml-1 text-green-500">↑</span>
        @else
            <span class="ml-1 text-red-500">↓</span>
        @endif
    @endif
</button>
