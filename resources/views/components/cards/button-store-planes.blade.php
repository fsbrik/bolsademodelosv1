@props(['planSeleccionado'])
{{ $planSeleccionado }}

<button type="button" class="w-full text-purple-700 bg-white rounded transition duration-150 ease-in-out py-4 mt-4"
    title="Seleccionar plan"  wire:click="store('{{ $planSeleccionado }}')">
    {{ __('Seleccionar plan') }}
</button>


