<div class="grid grid-cols-1 sm:grid-rows-2 sm:grid-cols-12 sm:gap-3">

    <!-- Tipo -->
    <x-field span=2>
        <label for="tipo">{{ __('Tipo') }}</label>
        <select id="tipo" wire:model="empresa.tipo">
            <option value="A">{{ __('A') }}</option>
            <option value="C">{{ __('C') }}</option>
        <select>
    </x-field>

    <!-- Cuit -->
    <x-field span=3>
        <label for="cuit">{{ __('CUIT') }}</label>
        <input id="cuit" wire:model="empresa.cuit" type="text" placeholder="00-00000000-0"/>
    </x-field>

    <!-- Rubro -->
    {{-- <x-field span=7 class="grid grid-cols-subgrid">
        <x-field span=3>
            <label for="rubro">{{ __('Rubro') }}</label>
            <input id="rubro" wire:model="empresa.rubro" type="text" />
        </x-field>
    </x-field> --}}
    <x-field span=4>
        <label for="rubro">{{ __('Rubro') }}</label>
        <input id="rubro" wire:model="empresa.rubro" type="text" />
    </x-field>

    <!-- Nombre Comercial -->
    <x-field span=4 class="sm:row-start-2">
        <label for="nom_com">{{ __('Nombre Comercial') }}</label>
        <input id="nom_com" wire:model="empresa.nom_com" type="text" />
    </x-field>

    <!-- Domicilio -->
    <x-field span=8>
        <label for="domicilio">{{ __('Domicilio') }}</label>
        <input id="domicilio" wire:model="empresa.domicilio" type="text" />
    </x-field>

    <x-field span=12>
        <x-validation-errors ></x-validation-errors>
    </x-field>
</div>

