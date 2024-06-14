<x-form-section submit="updateModelo">
    <x-slot name="title">
        {{ __('Información adicional de la modelo') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Actualice la información de la modelo') }}
    </x-slot>

    <x-slot name="form">

        <!-- Mod Id -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="mod_id" value="{{ __('ID del Modelo') }}" />
            <x-input id="mod_id" type="text" class="mt-1 block w-full" wire:model="modelo.mod_id" disabled />
            <x-input-error for="modelo.mod_id" class="mt-2" />
        </div>

        <!-- Fecha de Nacimiento -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="fec_nac" value="{{ __('Fecha de Nacimiento') }}" />
            <x-input id="fec_nac" type="date" class="mt-1 block w-full" wire:model="modelo.fec_nac" />
            <x-input-error for="modelo.fec_nac" class="mt-2" />
        </div>

        <!-- Sexo -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="sexo" value="{{ __('Sexo') }}" />
            <select id="sexo"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                wire:model="modelo.sexo">
                <option value="M">{{ __('Masculino') }}</option>
                <option value="F">{{ __('Femenino') }}</option>
            </select>
            <x-input-error for="modelo.sexo" class="mt-2" />
        </div>

        <!-- Estatura -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="estatura" value="{{ __('Estatura') }}" />
            <x-input id="estatura" type="number" class="mt-1 block w-full" wire:model="modelo.estatura" step="0.01"
                placeholder="1.78" />
            <x-input-error for="modelo.estatura" class="mt-2" />
        </div>

        <!-- Medidas -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="medidas" value="{{ __('Medidas') }}" />
            <x-input id="medidas" type="text" class="mt-1 block w-full" wire:model="modelo.medidas"
                placeholder="90-60-90" />
            <x-input-error for="modelo.medidas" class="mt-2" />
        </div>

        <!-- Calzado -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="calzado" value="{{ __('Calzado') }}" />
            <x-input id="calzado" type="number" class="mt-1 block w-full" wire:model="modelo.calzado"
                step="0.5" />
            <x-input-error for="modelo.calzado" class="mt-2" />
        </div>

        <!-- Zona de Residencia -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="zon_res" value="{{ __('Zona de Residencia') }}" />
            <select id="zon_res" wire:model="modelo.zon_res"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @foreach ($localidades as $localidad)
                    <option value="{{ $localidad }}" {{ old('zon_res') == $localidad ? 'selected' : '' }}>
                        {{ __($localidad) }}
                    </option>
                @endforeach
            </select>
            <x-input-error for="modelo.zon_res" class="mt-2" />
        </div>

        <!-- Disponibilidad para viajar -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="dis_via" value="{{ __('Disponibilidad para Viajar') }}" />
            <select id="dis_via" wire:model="modelo.dis_via"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="1">{{ __('Sí') }}</option>
                <option value="0">{{ __('No') }}</option>
            </select>
            <x-input-error for="modelo.dis_via" class="mt-2" />
        </div>

        <!-- Título de Modelo -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="tit_mod" value="{{ __('Título de Modelo') }}" />
            <select id="tit_mod" wire:model="modelo.tit_mod"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="1">{{ __('Sí') }}</option>
                <option value="0">{{ __('No') }}</option>
            </select>
            <x-input-error for="modelo.tit_mod" class="mt-2" />
        </div>

        <!-- Nivel de inglés -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="ingles" value="{{ __('Nivel de Inglés') }}" />
            <select id="ingles" wire:model="modelo.ingles"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="basico">{{ __('Básico') }}</option>
                <option value="intermedio">{{ __('Intermedio') }}</option>
                <option value="avanzado">{{ __('Avanzado') }}</option>
            </select>
            <x-input-error for="modelo.ingles" class="mt-2" />
        </div>

        <!-- Disponible para trabajos -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="dis_tra" value="{{ __('Disponible para trabajos de') }}" />
            <select id="dis_tra" wire:model="modelo.dis_tra"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="modelo">{{ __('Modelo') }}</option>
                <option value="promotor/a">{{ __('Promotor/a') }}</option>
                <option value="ambos">{{ __('Ambos') }}</option>
            </select>
            <x-input-error for="modelo.dis_tra" class="mt-2" />
        </div>

        <!-- Descripción -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="descripcion" value="{{ __('Descripción') }}" />
            <textarea id="descripcion" wire:model="modelo.descripcion"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            <x-input-error for="modelo.descripcion" class="mt-2" />
        </div>

        <!-- Tarifa por media jornada -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="tar_med" value="{{ __('Tarifa por media jornada (U$S)') }}" />
            <x-input id="tar_med" type="number" class="mt-1 block w-full" wire:model="modelo.tar_med"
                step="0.01" />
            <x-input-error for="modelo.tar_med" class="mt-2" />
        </div>

        <!-- Tarifa por jornada completa -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="tar_com" value="{{ __('Tarifa por jornada completa (U$S)') }}" />
            <x-input id="tar_com" type="number" class="mt-1 block w-full" wire:model="modelo.tar_com"
                step="0.01" />
            <x-input-error for="modelo.tar_com" class="mt-2" />
        </div>

        <!-- Estado -->
        <div class="col-span-6 sm:col-span-4">
            <div class="col-span-6 sm:col-span-4 flex items-center">
                <x-label class="mr-2" for="estado" value="{{ __('Activo / Inactivo') }}" />
                <select id="estado" wire:model="modelo.estado"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="1">{{ __('Activo') }}</option>
                    <option value="0">{{ __('Inactivo') }}</option>
                </select>
            </div>
            <x-input-error for="modelo.estado" class="mt-2" />
        </div>

        <!-- Habilitar -->
        <div class="col-span-6 sm:col-span-4">
            <div class="col-span-6 sm:col-span-4 flex items-center">
                <x-label class="mr-2" for="habilita" value="{{ __('Habilitado / No habilitado') }}" />
                <select id="habilita" wire:model="modelo.habilita"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="0">{{ __('Inhabilitado') }}</option>
                    <option value="1">{{ __('Habilitado') }}</option>
                </select>
            </div>
            <x-input-error for="modelo.habilita" class="mt-2" />
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
