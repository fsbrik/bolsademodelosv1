@props([
    'titulo',
    'precio',
    'duracion',
    'descripcionCorta',
    'descripcionLarga' => [],
    'value',
    'planSeleccionado',
    'disabled' => false,
])

@php
    $isSelected = $planSeleccionado === $value;
@endphp

<div
    class="flex flex-col basis-full md:basis-1/4 {{ $isSelected ? 'bg-purple-500' : 'bg-purple-300' }} 
    rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 mb-5">
    <div class="flex flex-col flex-grow mx-auto">
        <h3 class="text-gray-600 text-lg">{{ $titulo }}</h3>
        <p class="text-gray-600 mt-1"><span class="font-bold text-black text-4xl">${{ $precio }}</span> /{{ $duracion }}</p>
        <p class="text-sm text-gray-600 mt-2">{{ $descripcionCorta }}</p>
        @if ($descripcionLarga)
            <div class="text-sm text-gray-600 mt-4">
                @foreach ($descripcionLarga as $item)
                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>{{ $item }}</p>
                @endforeach
            </div>
        @endif
    </div>
    <label class="block w-full mt-2 {{ $isSelected ? '' : 'cursor-pointer' }}">
        <input
            type="radio"
            value="{{ $value }}"
            wire:model="plan.planSeleccionado"
            wire:click="update"
            class="hidden peer"
            @if($disabled) disabled @endif
        >
        <div class="peer-checked:bg-purple-700 peer-checked:text-white text-base
                    bg-white text-purple-700 rounded transition duration-150 ease-in-out py-4 text-center">
            {{ $titulo }}
        </div>
    </label>
</div>
