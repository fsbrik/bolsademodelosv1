@props(['hidden' => false])

@if (!$hidden)
    <button wire:click="edit" {{ $attributes->merge(['class' => 'a-btn-edit']) }} title="Editar">
        {{ __('Editar') }}
    </button>
@endif
