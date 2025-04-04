<div class="grid grid-cols-1 sm:grid-rows-2 sm:grid-cols-12 sm:gap-3">

    <!-- Tipo -->
    <x-field>
        <x-label for="tipo" value="{{ __('Tipo') }}" />
        <x-select id="tipo" wire:model="empresa.tipo">
            <option value="A">{{ __('A') }}</option>
            <option value="C">{{ __('C') }}</option>
        </x-select>
        <x-input-error for="empresa.tipo" class="mt-2" />
    </x-field>

    <!-- Cuit -->
    <x-field span=2>
        <x-label for="cuit" value="{{ __('CUIT') }}" />
        <x-input id="cuit" wire:model="empresa.cuit" type="text" />
        <x-input-error for="empresa.cuit" class="mt-2" />
    </x-field>

    <!-- Rubro -->
    <x-field span=9 class="grid grid-cols-subgrid">
        <x-field span=4>
            <x-label for="rubro" value="{{ __('Rubro') }}" />
            <x-input id="rubro" wire:model="empresa.rubro" type="text" />
            <x-input-error for="empresa.rubro" class="mt-2" />
        </x-field>
    </x-field>

    <!-- Nombre Comercial -->
    <x-field span=4>
        <x-label for="nom_com" value="{{ __('Nombre Comercial') }}" />
        <x-input id="nom_com" wire:model="empresa.nom_com" type="text" />
        <x-input-error for="empresa.nom_com" class="mt-2" />
    </x-field>

    <!-- Domicilio -->
    <x-field span=8>
        <x-label for="domicilio" value="{{ __('Domicilio') }}" />
        <x-input id="domicilio" wire:model="empresa.domicilio" type="text" />
        <x-input-error for="empresa.domicilio" class="mt-2" />
    </x-field>
</div>