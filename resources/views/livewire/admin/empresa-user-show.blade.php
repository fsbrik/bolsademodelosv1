<x-action-section>
    <x-slot name="title">
        {{ __('Usuario Empresa') }}
    </x-slot>
    <x-slot name="description">
    </x-slot>
    
    <x-slot name="content">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Nombre y apellido') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="empresa.name" disabled/>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="telefono" value="{{ __('Teléfono') }}" />
            <x-input id="telefono" type="text" class="mt-1 block w-full" wire:model="empresa.telefono" disabled />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('E-mail') }}" />
            <x-input id="email" type="text" class="mt-1 block w-full" wire:model="empresa.email" disabled />
        </div>

    </x-slot>
</x-action-section>
