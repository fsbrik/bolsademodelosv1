<x-form-section submit="updateEmpresa">

    <x-slot name="title">{{ __('Información comercial') }}</x-slot>
    <x-slot name="description">{{ __('Actualice la información de su empresa') }}</x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="nom_com" value="{{ __('Nombre comercial') }}" />
            <x-input id="nom_com" type="text" class="mt-1 block w-full" wire:model="empresa.nom_com" />
            <x-input-error for="empresa.nom_com" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="domicilio" value="{{ __('Domicilio') }}" />
            <x-input id="domicilio" type="text" class="mt-1 block w-full" wire:model="empresa.domicilio" />
            <x-input-error for="empresa.domicilio" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="rubro" value="{{ __('Rubro') }}" />
            <x-input id="rubro" type="text" class="mt-1 block w-full" wire:model="empresa.rubro" />
            <x-input-error for="empresa.rubro" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="tipo" value="{{ __('Tipo') }}" />
            <select id="tipo" wire:model="empresa.tipo"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="A">{{ __('A') }}</option>
                <option value="C">{{ __('C') }}</option>
            </select>
            <x-input-error for="empresa.tipo" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="cuit" value="{{ __('CUIT') }}" />
            <x-input id="cuit" type="text" class="mt-1 block w-full" wire:model="empresa.cuit" />
            <x-input-error for="empresa.cuit" class="mt-2" />
        </div>

        <!-- Agrega más campos según sea necesario -->
        <x-slot name="actions">
            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">

                    {{ __('Actualizar') }}

                </x-button>
            </div>
        </x-slot>
    </x-slot>
</x-form-section>
