@props(['planSeleccionado', 'planTarjeta'])

@php
    $clases = 'w-full text-purple-700 bg-white rounded transition duration-150 ease-in-out py-4 mt-4';
    $clases .= $planSeleccionado === $planTarjeta ? '' : ' hover:bg-purple-500 hover:text-white hover:shadow-xl';
    $disabled = $planSeleccionado === $planTarjeta ? 'disabled' : '';
@endphp

<button type="button"
    {{ $attributes->merge(['class' => $clases]) }}
    title="Guardar"
    {{ $disabled }}
    wire:click="store('{{ $planSeleccionado }}')">
    {{ $planSeleccionado === $planTarjeta ? 'Plan seleccionado' : 'Seleccionar plan' }}
</button>


