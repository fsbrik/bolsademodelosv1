<div class="flex">
    <div class="flex-1">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Lista de Modelos') }}
            </h2>
        </x-slot>

        <div class="py-4">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 bg-white border-b border-gray-200">
                        @can('modelos.filtros_administrador')
                            <div class="w-2/3 mx-auto bg-gray-100 grid grid-cols-9 gap-2 mb-4 p-4">
                                <div class="col-span-9 sm:col-span-1">
                                    <x-label for="searchModId" value="{{ __('ID') }}" class="text-xs" />
                                    <x-input id="searchModId" type="text" class="mt-1 block w-full text-sm"
                                        wire:model.live.debounce.250ms="searchModId" />
                                </div>
                                <div class="col-span-9 sm:col-span-3">
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
                        <button wire:click="toggleView" class="bg-gray-800 text-white px-4 py-2 rounded mb-4">
                            Toggle View
                        </button>


                        <div class="flex">
                            <aside class="w-44 p-2 bg-gray-100">
                                <div class="grid grid-cols-12 gap-2">
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
                                            class="block mt-1 w-1/2 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs"
                                            wire:model.live.debounce.250ms="searchSexo">
                                            <option value="">--</option>
                                            <option value="F">F</option>
                                            <option value="M">M</option>
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
                                            class="block mt-1 w-1/2 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs"
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
                                            class="block mt-1 w-1/2 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs"
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
                                    <div class="col-span-12 sm:col-span-12 -mb-3 mt-2">
                                        <p class="label-medium">{{ __('Tarifa 1/2 jornada') }}</p>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <x-label-sm for="searchTarMedMin" value="{{ __('min') }}"
                                            class="text-xs" />
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
                                            class="text-xs" />
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

                            @if ($showTable)
                                <div class="flex-1 ml-2">
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
                                                    @can('modelos.ficha_tecnica')
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
                                                            Tit. Modelo
                                                        </th>
                                                        <th scope="col"
                                                            class="px-1 py-2 text-center font-medium text-gray-500 uppercase ">
                                                            Inglés
                                                        </th>
                                                    @endcan
                                                    <th scope="col"
                                                        class="px-1 py-2 text-center font-medium text-gray-500 uppercase ">
                                                        Tipo Trabajo
                                                    </th>
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
                                                                <img src="{{ $modelo->user->profile_photo_url }}"
                                                                    alt="{{ $modelo->user->name }}"
                                                                    class="rounded-xl w-14 h-20 mx-auto object-cover">                                                     
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
                                                        @can('modelos.ficha_tecnica')
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
                                                        @endcan
                                                        <td class="px-1 py-2 text-center whitespace-nowrap">
                                                            {{ $modelo->dis_tra }}
                                                        </td>
                                                        <td class="px-1 py-2 text-center whitespace-nowrap">
                                                            {{ $modelo->tar_med }}
                                                        </td>
                                                        <td class="px-1 py-2 text-center whitespace-nowrap">
                                                            {{ $modelo->tar_com }}
                                                        </td>
                                                        @can('modelos.ver_estado')
                                                            <td class="px-1 py-2 text-center whitespace-nowrap">
                                                                <input type="radio" disabled checked
                                                                    class="{{ $modelo->estado == '1' ? 'text-green-500' : 'text-red-500' }}">
                                                            </td>
                                                        @endcan
                                                        <td
                                                            class="px-6 py-4 text-center whitespace-nowrap text-sm font-medium">
                                                            @can('modelos.show')
                                                                <a href="{{ route('modelos.show', $modelo->id) }}"
                                                                    class="text-indigo-600 hover:text-indigo-900"
                                                                    title="Ver">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            @endcan
                                                            @can('modelos.edit')
                                                                <a href="{{ route('modelos.edit', $modelo->id) }}"
                                                                    class="text-yellow-600 hover:text-yellow-900"
                                                                    title="Editar">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                            @endcan
                                                            @can('modelos.destroy')
                                                                <form action="{{ route('modelos.destroy', $modelo->id) }}"
                                                                    method="POST" class="inline">
                                                                    @csrf
                                                                    @method('DELETE')
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
                                    @else
                                        <div class="px-4 py-3">
                                            No se encontraron registros
                                        </div>
                                    @endif
                                </div>
                            @else
                                @livewire('modelo-card')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
