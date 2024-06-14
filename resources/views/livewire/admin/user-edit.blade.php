<x-form-section submit="updateUser">
    <x-slot name="title">
        {{ __('Información del usuario') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Actualice la información del usuario') }}
    </x-slot>

    <x-slot name="form">

        <!-- Id -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="id" value="{{ __('###') }}" />
            <x-input id="id" type="text" class="mt-1 block w-full" wire:model="user.id" disabled />
            <x-input-error for="user.id" class="mt-2" />
        </div>

        <!-- Nombre y apellido -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Nombre y apellido') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="user.name" />
            <x-input-error for="user.name" class="mt-2" />
        </div>

        <!-- Teléfono -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="telefono" value="{{ __('Teléfono') }}" />
            <x-input id="telefono" type="text" class="mt-1 block w-full" wire:model="user.telefono" />
            <x-input-error for="user.telefono" class="mt-2" />
        </div>

        <!-- E-mail -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('E-mail') }}" />
            <x-input id="email" type="text" class="mt-1 block w-full" wire:model="user.email" />
            <x-input-error for="user.email" class="mt-2" />
        </div>   
            
        <x-slot name="actions">
            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Actualizar') }}
                </x-button>
            </div>
        </x-slot>
    </x-slot>
</x-form-section>
