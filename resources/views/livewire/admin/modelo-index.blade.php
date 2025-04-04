<div class="flex">
    <div class="flex-1">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Listado de Modelos') }}
            </h2>
        </x-slot>

        <div class="py-2 @guest pt-1 w-full bg-white @endguest">
            <div class="max-w-full @guest w-full sm:w-fit @endguest mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 bg-white border-b border-gray-200">
                        @can('modelos.filtros_administrador')
                            <div class="w-2/3 mx-auto bg-gray-100 grid grid-cols-9 gap-2 mb-4 p-4">
                                {{-- <div class="col-span-9 sm:col-span-1">
                                    <x-label for="searchModId" value="{{ __('ID') }}" class="text-xs" />
                                    <x-input id="searchModId" type="text" class="mt-1 block w-full text-sm"
                                        wire:model.live.debounce.250ms="searchModId" />
                                </div> --}}
                                <div class="col-span-9 sm:col-span-4">
                                    <x-label for="searchName" value="{{ __('Nombre') }}" class="text-xs" />
                                    <x-input id="searchName" type="text" class="mt-1 block w-full text-sm"
                                        wire:model.live.debounce.250ms="searchName" />
                                </div>
                                <div class="col-span-9 sm:col-span-2">
                                    <x-label for="searchTelefono" value="{{ __('Teléfono') }}" class="text-xs" />
                                    <x-input id="searchTelefono" type="text" class="mt-1 block w-full text-sm"
                                        wire:model.live.debounce.250ms="searchTelefono" />
                                </div>
                                <div class="col-span-9 sm:col-span-3">
                                    <x-label for="searchEmail" value="{{ __('Email') }}" class="text-xs" />
                                    <x-input id="searchEmail" type="text" class="mt-1 block w-full text-sm"
                                        wire:model.live.debounce.250ms="searchEmail" />
                                </div>
                            </div>
                        @endcan

                        <div class="flex">
                            <aside class="w-20 sm:w-44 p-2 bg-gray-100 mr-2 rounded-md">
                                <div class="grid grid-cols-12 gap-0 sm:gap-2">
                                    <div class="col-span-12 sm:col-span-12">
                                        <x-label-sm for="searchModId" value="{{ __('ID') }}" class="text-xs" />
                                        <x-input id="searchModId" type="text" class="mt-1 block w-full sm:w-1/2 text-xs"
                                            wire:model.live.debounce.250ms="searchModId" />
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <x-label-sm for="searchEdadMin" value="{{ __('Edad Min') }}" class="text-xs" />
                                        <x-input id="searchEdadMin" type="number" class="mt-1 block w-full text-xs"
                                            wire:model.live.debounce.250ms="searchEdadMin" />
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <x-label-sm for="searchEdadMax" value="{{ __('Edad Max') }}" class="text-xs" />
                                        <x-input id="searchEdadMax" type="number" class="mt-1 block w-full text-xs"
                                            wire:model.live.debounce.250ms="searchEdadMax" />
                                    </div>
                                    <div class="col-span-12 sm:col-span-12">
                                        <x-label-sm for="searchSexo" value="{{ __('Sexo') }}" class="text-xs" />
                                        <select id="searchSexo"
                                            class="block mt-1 w-full sm:w-1/2 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs"
                                            wire:model.live.debounce.250ms="searchSexo">
                                            <option value="">--</option>
                                            <option value="F">Femenino</option>
                                            <option value="M">Masculino</option>
                                        </select>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <x-label-sm for="searchEstaturaMin" value="{{ __('Estatura Min') }}"
                                            class="text-xs" />
                                        <x-input id="searchEstaturaMin" type="number" class="mt-1 block w-full text-xs"
                                            wire:model.live.debounce.250ms="searchEstaturaMin" />
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <x-label-sm for="searchEstaturaMax" value="{{ __('Estatura Max') }}"
                                            class="text-xs" />
                                        <x-input id="searchEstaturaMax" type="number" class="mt-1 block w-full text-xs"
                                            wire:model.live.debounce.250ms="searchEstaturaMax" />
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <x-label-sm for="searchCabello" value="{{ __('Color de cabello') }}"
                                            class="text-xs" />
                                        <select id="searchCabello"
                                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs"
                                            wire:model.live.debounce.500ms="searchCabello">
                                            <option value="">--</option>
                                            <option value="rubio">{{ __('Rubio') }}</option>
                                            <option value="castaño">{{ __('Castaño') }}</option>
                                            <option value="pelirrojo">{{ __('Pelirrojo') }}</option>
                                            <option value="morocho">{{ __('Morocho') }}</option>
                                            <option value="otro">{{ __('Otro') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-span-12 sm:col-span-12">
                                        <x-label-sm for="searchZonRes" value="{{ __('Zona Resid.') }}"
                                            class="text-xs" />
                                        <select id="zon_res" wire:model.live.debounce.250ms="searchZonRes"
                                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs">
                                            <option value="">--</option>
                                            @foreach ($localidades as $localidad)
                                                <option value="{{ $localidad }}">
                                                    {{ __($localidad) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-span-12 sm:col-span-12">
                                        <x-label-sm for="searchDisVia" value="{{ __('Dispo Viajes') }}"
                                            class="text-xs" />
                                        <select id="searchDisVia"
                                            class="block mt-1 w-full sm:w-1/2 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs"
                                            wire:model.live.debounce.500ms="searchDisVia">
                                            <option value="">--</option>
                                            <option value="1">SI</option>
                                            <option value="0">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-span-12 sm:col-span-12">
                                        <x-label-sm for="searchTitMod" value="{{ __('Tit. Modelo') }}"
                                            class="text-xs" />
                                        <select id="searchTitMod"
                                            class="block mt-1 w-full sm:w-1/2 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs"
                                            wire:model.live.debounce.250ms="searchTitMod">
                                            <option value="">--</option>
                                            <option value="1">SI</option>
                                            <option value="0">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-span-12 sm:col-span-12">
                                        <x-label-sm for="searchIngles" value="{{ __('Inglés') }}"
                                            class="text-xs" />
                                        <select id="searchIngles"
                                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs"
                                            wire:model.live.debounce.250ms="searchIngles">
                                            <option value="">--</option>
                                            <option value="Básico">Básico</option>
                                            <option value="Intermedio">Intermedio</option>
                                            <option value="Avanzado">Avanzado</option>
                                        </select>
                                    </div>
                                    <div class="col-span-12 sm:col-span-12">
                                        <x-label-sm for="searchDisTra" value="{{ __('Tipo Trabajo') }}"
                                            class="text-xs" />
                                        <select id="searchDisTra"
                                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs"
                                            wire:model.live.debounce.250ms="searchDisTra">
                                            <option value="">--</option>
                                            <option value="Ambas">Ambas</option>
                                            <option value="Modelo">Modelo</option>
                                            <option value="Promotora">Promotor/a</option>
                                        </select>
                                    </div>
                                    @can('modelos.ficha_tecnica')
                                        <div class="col-span-12 sm:col-span-12 -mb-3 mt-2">
                                            <p class="label-medium">{{ __('Tarifa 1/2 jornada') }}</p>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <x-label-sm for="searchTarMedMin" value="{{ __('min') }}"
                                                class="text-xs mt-2 sm:mt-0" />
                                            <x-input id="searchTarMedMin" type="number"
                                                class="mt-1 block w-full text-xs"
                                                wire:model.live.debounce.250ms="searchTarMedMin" />
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <x-label-sm for="searchTarMedMax" value="{{ __('max') }}"
                                                class="text-xs" />
                                            <x-input id="searchTarMedMax" type="number"
                                                class="mt-1 block w-full text-xs"
                                                wire:model.live.debounce.250ms="searchTarMedMax" />
                                        </div>
                                        <div class="col-span-12 sm:col-span-12 -mb-3 mt-2">
                                            <p class="label-medium">{{ __('Tarifa jornada comp') }}</p>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <x-label-sm for="searchTarComMin" value="{{ __('min') }}"
                                                class="text-xs mt-2 sm:mt-0" />
                                            <x-input id="searchTarComMin" type="number"
                                                class="mt-1 block w-full text-xs"
                                                wire:model.live.debounce.250ms="searchTarComMin" />
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <x-label-sm for="searchTarComMax" value="{{ __('max') }}"
                                                class="text-xs" />
                                            <x-input id="searchTarComMax" type="number"
                                                class="mt-1 block w-full text-xs"
                                                wire:model.live.debounce.250ms="searchTarComMax" />
                                        </div>
                                    @endcan
                                    @can('modelos.filtros_administrador')
                                        <div class="col-span-12 sm:col-span-6">
                                            <x-label-sm for="searchEstado" value="{{ __('Estado') }}"
                                                class="text-xs" />
                                            <select id="searchEstado"
                                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs"
                                                wire:model.live.debounce.500ms="searchEstado">
                                                <option value="">--</option>
                                                <option value="1">Activo</option>
                                                <option value="0">Inactivo</option>
                                            </select>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <x-label-sm for="searchHabilita" value="{{ __('Habilitar') }}"
                                                class="text-xs" />
                                            <select id="searchHabilita"
                                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs"
                                                wire:model.live.debounce.500ms="searchHabilita">
                                                <option value="">--</option>
                                                <option value="1">Habilitado</option>
                                                <option value="0">No habilitado</option>
                                            </select>
                                        </div>
                                    @endcan
                                </div>
                            </aside>

                            <div x-data="{ toggle: window.innerWidth < 640}">
                                <section class="flex flex-wrap">
                                    <button @click="toggle = !toggle"
                                        class="bg-gray-800 text-white px-4 py-2 rounded mb-4 hidden sm:block">
                                        Cambiar vista
                                    </button>
                                    @if($modelosSeleccionadas)                                        
                                        <div x-data="{ open: true }" x-show="open"
                                            class="relative p-4 ml-2 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                                            role="alert">
                                            {{ __($seleccionMessage) }} {{ implode(', ', $modelosSeleccionadas )}}
                                        </div>
{{-- determinar si proviene de crear o editar --}}
{{-- @if($action == 'contratEdit')
    <a href="{{ route('empresas.contrataciones.edit', $contratacionId) }}"
        class="bg-gray-800 text-white px-4 py-3 rounded ml-2 mb-4 hidden sm:block">
        {{ __('Agregar modelos') }}
    </a>
@elseif($action == 'contratCreate')
    <a href="{{ route('empresas.contrataciones.create') }}"
        class="bg-gray-800 text-white px-4 py-3 rounded ml-2 mb-4 hidden sm:block">
        {{ __('Agregar modelos') }}
    </a>
@endif --}}
<button wire:click="addModelosSeleccionadas" class="bg-gray-800 text-white px-4 py-3 rounded ml-2 mb-4 hidden sm:block">
    {{ __('Agregar modelos') }}
</button>
                                    @endif
                                </section>

                                @if (session()->has('message'))
                                    <div x-data="{ open: true }" x-show="open"
                                        class="relative p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                                        role="alert">
                                        <button @click="open = false"
                                            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        {{ session('message') }}
                                    </div>
                                @endif
                                
                                {{-- Se visualiza la vista en formato de lista --}}
                                <div x-show="toggle" class="flex-1 ml-2">
                                    @if ($modelos->count())
                                        <table class="min-w-full divide-y divide-gray-200 text-xs">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-1 py-2 text-center font-medium text-gray-500 uppercase ">
                                                        ##
                                                    </th>
                                                    <th scope="col"
                                                        class="py-2 text-center font-medium text-gray-500 uppercase ">
                                                        Foto de <br>perfil
                                                    </th>
                                                    @can('modelos.datos_de_contacto')
                                                        <th scope="col"
                                                            class="py-2 text-center font-medium text-gray-500 uppercase ">
                                                            Nombre y Apellido
                                                        </th>
                                                        <th scope="col"
                                                            class="py-2 text-center font-medium text-gray-500 uppercase ">
                                                            Teléfono
                                                        </th>
                                                        <th scope="col"
                                                            class="py-2 text-center font-medium text-gray-500 uppercase ">
                                                            Email
                                                        </th>
                                                    @endcan
                                                    <th scope="col"
                                                        class="px-1 py-2 text-center font-medium text-gray-500 uppercase ">
                                                        Edad
                                                    </th>
                                                    <th scope="col"
                                                        class="px-1 py-2 text-center font-medium text-gray-500 uppercase ">
                                                        Sexo
                                                    </th>
                                                    <th scope="col"
                                                        class="px-1 py-2 text-center font-medium text-gray-500 uppercase ">
                                                        Estatura
                                                    </th>
                                                    <th scope="col"
                                                        class="px-1 py-2 text-center font-medium text-gray-500 uppercase ">
                                                        Calzado
                                                    </th>
                                                    <th scope="col"
                                                        class="px-1 py-2 text-center font-medium text-gray-500 uppercase ">
                                                        Medidas
                                                    </th>
                                                    <th scope="col"
                                                        class="px-1 py-2 text-center font-medium text-gray-500 uppercase ">
                                                        Zona Resid.
                                                    </th>
                                                    <th scope="col"
                                                        class="px-1 py-2 text-center font-medium text-gray-500 uppercase ">
                                                        Dispo Viajes
                                                    </th>
                                                    <th scope="col"
                                                        class="px-1 py-2 text-center font-medium text-gray-500 uppercase ">
                                                        Tit. de Modelo
                                                    </th>
                                                    <th scope="col"
                                                        class="px-1 py-2 text-center font-medium text-gray-500 uppercase ">
                                                        Inglés
                                                    </th>
                                                    <th scope="col"
                                                        class="px-1 py-2 text-center font-medium text-gray-500 uppercase ">
                                                        Tipo Trabajo
                                                    </th>
                                                    @can('modelos.ficha_tecnica')
                                                        <th scope="col"
                                                            class="px-1 py-2 text-center font-medium text-gray-500 uppercase  cursor-pointer">
                                                            <button class="flex items-center"
                                                                wire:click="sortBy('tar_med')">
                                                                1/2 JORNADA<br />(U$S)
                                                                @if ($sort_By === 'tar_med')
                                                                    @if ($sortDirection === 'asc')
                                                                        <span class="ml-1 text-green-500">↑</span>
                                                                    @else
                                                                        <span class="ml-1 text-red-500">↓</span>
                                                                    @endif
                                                                @endif
                                                            </button>
                                                        </th>
                                                        <th scope="col"
                                                            class="px-1 py-2  font-medium text-gray-500 uppercase  cursor-pointer">
                                                            <button class="flex items-center"
                                                                wire:click="sortBy('tar_com')">
                                                                JORNADA COMP.<br />(U$S)
                                                                @if ($sort_By === 'tar_com')
                                                                    @if ($sortDirection === 'asc')
                                                                        <span class="ml-1 text-green-500">↑</span>
                                                                    @else
                                                                        <span class="ml-1 text-red-500">↓</span>
                                                                    @endif
                                                                @endif
                                                            </button>
                                                        </th>
                                                    @endcan
                                                    @can('modelos.ver_estado')
                                                        <th scope="col"
                                                            class="px-1 py-2 text-center font-medium text-gray-500 uppercase ">
                                                            Estado
                                                        </th>
                                                    @endcan
                                                    <th scope="col"
                                                        class="px-1 py-2 text-center font-medium text-gray-500 uppercase ">
                                                        Acciones
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach ($modelos as $modelo)
                                                    <tr>
                                                        <td class="py-2 text-center whitespace-nowrap">
                                                            {{ $modelo->mod_id }}
                                                        </td>
                                                        <td class="py-2  whitespace-nowrap">                                                            
                                                            <img src="{{$modelo->user->profile_photo_url}}" alt="{{ $modelo->mod_id }}"
                                                                class="rounded-xl w-14 h-20 mx-auto object-cover" />
                                                        </td>
                                                        @can('modelos.datos_de_contacto')
                                                            <td class="py-2 text-center whitespace-nowrap">
                                                                {{ $modelo->user->name }}
                                                            </td>
                                                            <td class="py-2 text-center whitespace-nowrap">
                                                                {{ $modelo->user->telefono }}
                                                            </td>
                                                            <td class="py-2 text-center whitespace-wrap">
                                                                {{ $modelo->user->email }}
                                                            </td>
                                                        @endcan                                                        
                                                        <td class="px-1 py-2 text-center whitespace-nowrap">
                                                            {{ \Carbon\Carbon::parse($modelo->fec_nac)->age }}
                                                        </td>
                                                        <td class="px-1 py-2 text-center whitespace-nowrap">
                                                            {{ $modelo->sexo }}
                                                        </td>
                                                        <td class="px-1 py-2 text-center whitespace-nowrap">
                                                            {{ $modelo->estatura }}
                                                        </td>
                                                        <td class="px-1 py-2 text-center whitespace-nowrap">
                                                            {{ $modelo->calzado }}
                                                        </td>
                                                        <td class="px-1 py-2 text-center whitespace-nowrap">
                                                            {{ $modelo->medidas }}
                                                        </td>
                                                        <td class="px-1 py-2 text-center whitespace-wrap">
                                                            {{ $modelo->zon_res }}
                                                        </td>
                                                        <td class="px-1 py-2 text-center whitespace-nowrap">
                                                            {{ $modelo->dis_via ? 'SI' : 'NO' }}
                                                        </td>
                                                        <td class="px-1 py-2 text-center whitespace-nowrap">
                                                            {{ $modelo->tit_mod ? 'SI' : 'NO' }}
                                                        </td>
                                                        <td class="px-1 py-2 text-center whitespace-nowrap">
                                                            {{ $modelo->ingles }}
                                                        </td>
                                                        <td class="px-1 py-2 text-center whitespace-nowrap">
                                                            {{ $modelo->dis_tra }}
                                                        </td>
                                                        @can('modelos.ficha_tecnica')
                                                            <td class="px-1 py-2 text-center whitespace-nowrap">
                                                                {{ $modelo->tar_med }}
                                                            </td>
                                                            <td class="px-1 py-2 text-center whitespace-nowrap">
                                                                {{ $modelo->tar_com }}
                                                            </td>
                                                        @endcan
                                                        @can('modelos.ver_estado')
                                                            <td class="px-1 py-2 text-center whitespace-nowrap">
                                                                <input type="radio" disabled checked
                                                                    class="{{ $modelo->estado == '1' ? 'text-green-500' : 'text-red-500' }}">
                                                            </td>
                                                        @endcan
                                                        <td class="px-6 py-4 text-center whitespace-nowrap text-sm font-medium">
                                                            @can('modelos.show')
                                                                <a href="{{ route('modelos.show', $modelo->id) }}"
                                                                    class="text-indigo-600 hover:text-indigo-900"
                                                                    title="Ver">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            @endcan
                                                            {{-- Ver todas las fotos de la modelo --}}
                                                            <i class="fas fa-image text-success cursor-pointer"
                                                                wire:click="$dispatch('openGallery', { modeloId: {{ $modelo->id }} })"></i>
                                                            {{-- Seleccionar o remover modelo --}}
                                                            @can('empresas.contratar_modelos')                                                                
                                                                <section class="inline">
                                                                   {{-- Botón para remover el modelo --}}
                                                                   @if(in_array($modelo->mod_id, $modelosSeleccionadas))
                                                                        @if ($this->confirmacionEstado($modelo) === 'Pendiente')
                                                                            <button wire:click="removeModelo({{ $modelo->id }})"
                                                                                class="text-red-600 hover:text-red-900"
                                                                                title="Remover">
                                                                                <i class="fas fa-circle-minus"></i>
                                                                            </button>
                                                                        @endif
                                                                    @else
                                                                        {{-- Botón para seleccionar el modelo --}}
                                                                        <button wire:click="selectModelo({{ $modelo->id }})"
                                                                            class="text-green-600 hover:text-green-900"
                                                                            title="Seleccionar">
                                                                            <i class="fas fa-add"></i>
                                                                        </button>
                                                                    @endif
                                                                </section>
                                                            @endcan

                                                            {{-- Editar modelos --}}
                                                            @can('modelos.edit')
                                                                <a href="{{ route('modelos.edit', $modelo->id) }}"
                                                                    class="text-yellow-600 hover:text-yellow-900"
                                                                    title="Editar">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                            @endcan
                                                            {{-- Eliminar modelos --}}
                                                            @can('modelos.destroy')
                                                                <form wire:submit="destroy({{ $modelo->id }})" class="inline">                                                                    
                                                                    <button type="submit"
                                                                        class="text-red-600 hover:text-red-900"
                                                                        title="Borrar"
                                                                        onclick="return confirm('¿Estás seguro de que deseas eliminar tu ficha?');">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                </form>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <div class="mt-4">
                                            {{ $modelos->links() }}
                                        </div>
                                        {{-- Abre el modal con la galeria de fotos de la modelo seleccionada --}}
                                        {{-- @livewire('modelo-galeria') --}}
                                    @else
                                        <div class="px-4 py-3">
                                            No se encontraron registros
                                        </div>
                                    @endif
                                </div>
                                <div x-show="!toggle">
                                    @if($modelos->count())
                                        {{-- Se visualiza la vista en formato de tarjetas --}}
                                        <div class="ml-2 grid grid-cols-1 md:grid-cols-4 lg:grid-cols-5 gap-2">
                                            @foreach ($modelos as $modelo)
                                                <div class="flex flex-col">
                                                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                                        <div class="p-2 flex justify-between">
                                                            <img src="{{ $modelo->user->profile_photo_url }}" alt="{{ $modelo->mod_id }}"
                                                                class="h-48 w-28 rounded-md object-cover">
                                                            <div class="flex flex-col ml-1">
                                                                <p class="font-semibold">## {{ $modelo->mod_id }}</p>
                                                                @can('modelos.datos_de_contacto')
                                                                <x-label-sm class="border-t break-all">{{ $modelo->user->name }}</x-label-sm>
                                                                <x-label-sm>{{ $modelo->user->telefono }}</x-label-sm>
                                                                <x-label-sm class="border-b break-all">{{ $modelo->user->email }}</x-label-sm>
                                                                @endcan
                                                                <x-label-sm>{{ __('Edad: ') . \Carbon\Carbon::parse($modelo->fec_nac)->age . __(' años') }}</x-label-sm>
                                                                <x-label-sm>{{ __('Estatura: ') . $modelo->estatura . __(' mts.') }}</x-label-sm>
                                                                <x-label-sm>{{ __('Calzado: ') . $modelo->calzado }}</x-label-sm>
                                                                <x-label-sm>{{ __('Medidas: ') . $modelo->medidas }}</x-label-sm>
                                                                <x-label-sm>{{ __('Viajar al exterior: ') . ($modelo->dis_via ? 'si' : 'no') }}</x-label-sm>
                                                                <x-label-sm class="border-b">{{ __('Título de modelo: ') . ($modelo->tit_mod ? 'si' : 'no') }}</x-label-sm>
                                                                @can('modelos.ficha_tecnica')
                                                                <x-label-sm><i class="fas fa-money-bill-wave"></i><i class="fas fa-money-bill-wave px-1"></i><i
                                                                        class="fas fa-money-bill-wave"></i></x-label-sm>
                                                                <x-label-sm>{{ __('1/2 jornada: u$s') . $modelo->tar_med }}</x-label-sm>
                                                                <x-label-sm>{{ __('Jorn. comp.: u$s') . $modelo->tar_com }}</x-label-sm>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                        <div class="px-2 flex border-t flex-auto items-center">
                                                            <i
                                                                class="fas fa-map-marker-alt pr-1"></i><x-label-sm>{{ __('Residencia: ') . $modelo->zon_res }}</x-label-sm>
                                                        </div>
                                                        <div class="p-2 flex justify-between">
                                                            <div class="">
                                                                <x-label-sm><i class="fas fa-book"></i>
                                                                    {{ __('Nivel de inglés: ') . $modelo->ingles }}</x-label-sm>
                                                                <x-label-sm><i class="fas fa-briefcase"></i>
                                                                    {{ __('Disponibilidad: ') . $modelo->dis_tra }}</x-label-sm>
                                                            </div>
                                        
                                                            <div class="px-2 -mt-5 flex justify-between shadow-md rounded-lg overflow-hidden items-center">
                                                                @can('modelos.show')
                                                                    <a href="{{ route('modelos.show', $modelo->id) }}"
                                                                        class="text-indigo-600 hover:text-indigo-900 pr-2" title="Ver">
                                                                        <i class="fas fa-eye"></i>
                                                                    </a>
                                                                @endcan
                                                                <i class="fas fa-image text-success cursor-pointer"
                                                                    wire:click="$dispatch('openGallery', { modeloId: {{ $modelo->id }} })"></i>
                                                                {{-- Seleccionar o remover modelo --}}
                                                                @can('empresas.contratar_modelos')                                                            
                                                                    <section class="inline ml-2">
                                                                        {{-- Botón para remover el modelo --}}
                                                                    @if(in_array($modelo->mod_id, $modelosSeleccionadas))
                                                                        @if ($this->confirmacionEstado($modelo) === 'Pendiente')
                                                                            <button wire:click="removeModelo({{ $modelo->id }})"
                                                                                class="text-red-600 hover:text-red-900"
                                                                                title="Remover">
                                                                                <i class="fas fa-circle-minus"></i>
                                                                            </button>
                                                                        @endif
                                                                    @else
                                                                        {{-- Botón para seleccionar el modelo --}}
                                                                        <button wire:click="selectModelo({{ $modelo->id }})"
                                                                            class="text-green-600 hover:text-green-900"
                                                                            title="Seleccionar">
                                                                            <i class="fas fa-add"></i>
                                                                        </button>
                                                                    @endif
                                                                    </section>
                                                                @endcan
                                                            </div>
                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="mt-4 col-span-1 md:col-span-4 lg:col-span-5">
                                                {{ $modelos->links() }}
                                            </div>
                                            
                                        </div>
                                    @else
                                        <div class="px-4 py-3">
                                            No se encontraron registros
                                        </div>
                                    @endif
                                </div>
                                {{-- Abre el modal con la galeria de fotos de la modelo seleccionada --}}
                                @livewire('modelo-galeria')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
