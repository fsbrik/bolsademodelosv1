@props(['hidden' => false])

@if (!$hidden)
    <button wire:click="show" {{ $attributes->merge(['class' => 'a-btn-show']) }} title="Ver">
        {{ __('Ver') }}
    </button>
@endif
