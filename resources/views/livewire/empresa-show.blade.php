<div>
    <div class="grid grid-cols-1 sm:grid md:grid-cols-12 sm:gap-3">
        <!-- Tipo -->
        <div class="col-span-12 sm:col-span-1">
            <x-label for="tipo" value="{{ __('Tipo') }}" />
            <x-input id="tipo" type="text" class="mt-1 block w-full" wire:model="empresa.tipo" disabled />
        </div>

        <!-- Cuit -->
        <div class="col-span-12 sm:col-span-2">
            <x-label for="cuit" value="{{ __('CUIT') }}" />
            <x-input id="cuit" type="text" class="mt-1 block w-full" wire:model="empresa.cuit" disabled />
        </div>

        <!-- Rubro -->
        <div class="col-span-12 sm:col-span-9">
            <x-label for="rubro" value="{{ __('Rubro') }}" />
            <x-input id="rubro" type="text" class="mt-1 block w-full sm:w-1/3" wire:model="empresa.rubro" disabled />
        </div>

        <!-- Nombre Comercial -->
        <div class="col-span-12 sm:col-span-4">
            <x-label for="nom_com" value="{{ __('Nombre comercial') }}" />
            <x-input id="nom_com" type="text" class="mt-1 block w-full" wire:model="empresa.nom_com" disabled />
        </div>

        <!-- Domicilio -->
        <div class="col-span-12 sm:col-span-8">
            <x-label for="domicilio" value="{{ __('Domicilio') }}" />
            <x-input id="domicilio" type="text" class="mt-1 block w-full" wire:model="empresa.domicilio" disabled />
        </div>







    </div>
    <div class="flex items-center justify-end mt-4">
        <a href="{{ route('empresas.edit', $empresa['id']) }}" class="text-yellow-600 hover:text-yellow-900 ml-4"
            title="Editar">
            <i class="fas fa-edit"></i>
        </a>
        <form wire:submit="destroy" class="inline ml-4">
            @csrf
            <button type="submit" class="text-red-600 hover:text-red-900" title="Borrar"
                onclick="return confirm('¿Estás seguro de que deseas eliminar esta empresa?');">
                <i class="fas fa-trash-alt"></i>
            </button>
        </form>
        @can('empresas.index')
            <x-button class="ml-4">
                <a wire:navigate href="{{ route('empresas.index') }}">
                    {{ __('Volver') }}
                </a>
            </x-button>
        @endcan
    </div>
</div>
