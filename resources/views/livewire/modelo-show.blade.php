<div>
    <div class="grid grid-cols-1 md:grid md:grid-cols-12 md:gap-3">
        <!-- Mod Id -->
        <div class="col-span-12 sm:col-span-12">
            <x-label for="mod_id" value="{{ __('ID del Modelo') }}" />
            <x-input id="mod_id" type="text" class="mt-1 block w-1/12" wire:model="modelo.mod_id" disabled />
            <x-input-error for="modelo.mod_id" class="mt-2" />
        </div>

        <!-- Fecha de Nacimiento -->
        <div class="col-span-12 sm:col-span-2">
            <x-label for="fec_nac" value="{{ __('Fecha de Nacimiento') }}" />
            <x-input id="fec_nac" type="date" class="mt-1 block w-2/3" wire:model="modelo.fec_nac" disabled />
            <x-input-error for="modelo.fec_nac" class="mt-2" />
        </div>

        <!-- Sexo -->
        <div class="col-span-12 sm:col-span-1">
            <x-label for="sexo" value="{{ __('Sexo') }}" />
            <x-input id="sexo" type="text" class="mt-1 block w-1/2" wire:model="modelo.sexo" disabled />
            <x-input-error for="modelo.sexo" class="mt-2" />
        </div>

        <!-- Estatura -->
        <div class="col-span-12 sm:col-span-1">
            <x-label for="estatura" value="{{ __('Estatura') }}" />
            <x-input id="estatura" type="number" class="mt-1 block w-2/3" wire:model="modelo.estatura" step="0.01"
                disabled />
            <x-input-error for="modelo.estatura" class="mt-2" />
        </div>

        <!-- Color del cabello -->
        <div class="col-span-12 sm:col-span-2">
            <x-label for="col_cab" value="{{ __('Color del cabello') }}" />
            <x-input id="col_cab" type="text" class="mt-1 block w-2/3" wire:model="modelo.col_cab" disabled />
            <x-input-error for="modelo.col_cab" class="mt-2" />
        </div>

        <!-- Medidas -->
        <div class="col-span-12 sm:col-span-1">
            <x-label for="medidas" value="{{ __('Medidas') }}" />
            <x-input id="medidas" type="text" class="mt-1 block w-full" wire:model="modelo.medidas" disabled />
            <x-input-error for="modelo.medidas" class="mt-2" />
        </div>

        <!-- Calzado -->
        <div class="col-span-12 sm:col-span-1">
            <x-label for="calzado" value="{{ __('Calzado') }}" />
            <x-input id="calzado" type="text" class="mt-1 block w-2/3" wire:model="modelo.calzado" disabled />
            <x-input-error for="modelo.calzado" class="mt-2" />
        </div>

        <!-- Zona de Residencia -->
        <div class="col-span-12 sm:col-span-4">
            <x-label for="zon_res" value="{{ __('Zona de Residencia') }}" />
            <x-input id="zon_res" type="text" class="mt-1 block w-1/2" wire:model="modelo.zon_res" disabled />
            <x-input-error for="modelo.zon_res" class="mt-2" />
        </div>

        <!-- Disponibilidad para viajar -->
        <div class="col-span-12 sm:col-span-2">
            <x-label for="dis_via" value="{{ __('Disponibilidad para Viajar') }}" />
            <x-input id="dis_via" type="text" class="mt-1 block w-1/3" value="{{ $this->disvia_display }}"
                disabled />
            <x-input-error for="modelo.dis_via" class="mt-2" />
        </div>

        <!-- Título de Modelo -->
        <div class="col-span-12 sm:col-span-2">
            <x-label for="tit_mod" value="{{ __('Título de Modelo') }}" />
            <x-input id="tit_mod" type="text" class="mt-1 block w-1/3" value="{{ $this->titmod_display }}"
                disabled />
            <x-input-error for="modelo.tit_mod" class="mt-2" />
        </div>

        <!-- Nivel de inglés -->
        <div class="col-span-12 sm:col-span-2">
            <x-label for="ingles" value="{{ __('Nivel de Inglés') }}" />
            <x-input id="ingles" type="text" class="mt-1 block w-1/2" wire:model="modelo.ingles" disabled />
            <x-input-error for="modelo.ingles" class="mt-2" />
        </div>

        <!-- Disponible para trabajos -->
        <div class="col-span-12 sm:col-span-6">
            <x-label for="dis_tra" value="{{ __('Disponible para trabajos de') }}" />
            <x-input id="dis_tra" type="text" class="mt-1 block w-1/2" wire:model="modelo.dis_tra" disabled />
            <x-input-error for="modelo.dis_tra" class="mt-2" />
        </div>

        <!-- Descripción -->
        <div class="col-span-12 sm:col-span-12">
            <x-label for="descripcion" value="{{ __('Descripción') }}" />
            <textarea id="descripcion" wire:model="modelo.descripcion" disabled
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            <x-input-error for="modelo.descripcion" class="mt-2" />
        </div>

        <!-- Tarifa por media jornada -->
        <div class="col-span-12 sm:col-span-3">
            <x-label for="tar_med" value="{{ __('Tarifa por media jornada (U$S)') }}" />
            <x-input id="tar_med" type="number" class="mt-1 block w-1/3" wire:model="modelo.tar_med"
                step="0.01" disabled />
            <x-input-error for="modelo.tar_med" class="mt-2" />
        </div>

        <!-- Tarifa por jornada completa -->
        <div class="col-span-12 sm:col-span-9">
            <x-label for="tar_com" value="{{ __('Tarifa por jornada completa (U$S)') }}" />
            <x-input id="tar_com" type="number" class="mt-1 block w-1/9" wire:model="modelo.tar_com"
                step="0.01" disabled />
            <x-input-error for="modelo.tar_com" class="mt-2" />
        </div>

        <!-- Estado -->
        @can('modelos.ver_estado')
            <div class="col-span-12 sm:col-span-1">
                <x-label for="estado" value="{{ __('Estado') }}" />
                <x-input id="estado" type="text" :class="$modelo['estado'] == 1 ? 'bg-green-500 mt-1 block w-full' : 'bg-red-500 mt-1 block w-full'" value="{{ $this->estado_display }}" disabled />
                <x-input-error for="estado" class="mt-2" />
            </div>
        @endcan

        <!-- Habilitar -->
        @can('modelos.ver_habilitar')
            <div class="col-span-12 sm:col-span-11">
                <x-label for="habilita" value="{{ __('Habilitado?') }}" />
                <x-input id="habilita" type="text" class="mt-1 block w-8  " value="{{ $this->habilita_display }}"
                    disabled />
                <x-input-error for="habilita" class="mt-2" />
            </div>
        @endcan

    </div>
    <x-section-border />

    <div class="flex items-center justify-end mt-4">
        @can('modelos.edit')
            <a href="{{ route('modelos.edit', $modelo['id']) }}" class="text-yellow-600 hover:text-yellow-900 ml-4"
                title="Editar">
                <i class="fas fa-edit"></i>
            </a>
        @endcan
        @can('modelos.destroy')
            <form action="{{ route('modelos.destroy', $modelo['id']) }}" method="POST" class="inline ml-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-900" title="Borrar"
                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta modelo?');">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
        @endcan
        @can('modelos.index')
            <x-button class="ml-4">
                <a href="{{ route('modelos.index') }}">
                    {{ __('Volver') }}
                </a>
            </x-button>
        @endcan
    </div>
</div>
