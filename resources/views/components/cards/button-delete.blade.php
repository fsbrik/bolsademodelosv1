@props(['param' => false, 'tipo', 'hidden' => false])

@if (!$hidden)
    <button type="button" {{ $attributes->merge(['class' => 'a-btn-delete']) }} title="Borrar"
        wire:click="destroy({{ $param ?? '' }})"
        wire:confirm="¿Estás seguro de que deseas eliminar {{ $tipo }}?">
        {{ __('Eliminar' )}}
    </button>
@endif
