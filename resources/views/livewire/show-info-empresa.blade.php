<x-action-section>
    <x-slot name="title">
        {{ __('Empresa') }}
    </x-slot>
    <x-slot name="description">
    </x-slot>
    
    <x-slot name="content">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="nom_com" value="{{ __('Nombre comercial') }}" />
            <x-input id="nom_com" type="text" class="mt-1 block w-full" wire:model="empresa.nom_com" disabled/>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="domicilio" value="{{ __('Domicilio') }}" />
            <x-input id="domicilio" type="text" class="mt-1 block w-full" wire:model="empresa.domicilio" disabled />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="rubro" value="{{ __('Rubro') }}" />
            <x-input id="rubro" type="text" class="mt-1 block w-full" wire:model="empresa.rubro" disabled />
        </div>

    </x-slot>
</x-action-section>
