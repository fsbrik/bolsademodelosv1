@props(['hidden' => false])

@if (!$hidden)
    <button type="button" {{ $attributes->merge(['class' => 'a-btn-update']) }} title="Actualizar" wire:click="update">
        {{ __('Actualizar') }}
    </button>
@endif
