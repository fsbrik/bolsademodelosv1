@props(['param' => false, 'tipo', 'hidden' => false])

@if (!$hidden)
    <button type="button" class="text-red-500 hover:text-red-700 text-pretty ml-1" title="Borrar"
        wire:click="destroy({{ $param ?? '' }})"
        wire:confirm="¿Estás seguro de que deseas eliminar {{ $tipo }}?">
        <i class="fas fa-trash-alt"></i>
    </button>
@endif
