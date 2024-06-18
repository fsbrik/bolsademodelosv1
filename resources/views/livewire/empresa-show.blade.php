<x-action-section :title="'Empresa'" :description="''">    
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

        <div class="col-span-6 sm:col-span-4">
            <x-label for="tipo" value="{{ __('Tipo') }}" />
            <x-input id="tipo" type="text" class="mt-1 block w-full" wire:model="empresa.tipo" disabled />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="cuit" value="{{ __('CUIT') }}" />
            <x-input id="cuit" type="text" class="mt-1 block w-full" wire:model="empresa.cuit" disabled />
        </div>
    </x-slot>
</x-action-section>
