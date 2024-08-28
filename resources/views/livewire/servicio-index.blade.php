<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Servicios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session()->has('message'))
                        <div x-data="{ open: true }" x-show="open" class="relative p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                            role="alert">
                            <button @click="open = false"
                                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </button>
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="w-2/3 mx-auto bg-gray-100 grid grid-cols-6 sm:grid-cols-12 gap-2 mb-4 p-4">
                        <div class="col-span-6 sm:col-span-3">
                            <x-label for="searchName" value="{{ __('Denominación') }}" />
                            <x-input id="searchName" type="text" class="mt-1 block w-full"
                                wire:model.live.debounce.250ms="searchName" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-label for="searchCategory" value="{{ __('Categoría') }}" />
                            <x-input id="searchCategory" type="text" class="mt-1 block w-full"
                                wire:model.live.debounce.250ms="searchCategory" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-label for="searchSubCategory" value="{{ __('Subcategoría') }}" />
                            <x-input id="searchSubCategory" type="text" class="mt-1 block w-full"
                                wire:model.live.debounce.250ms="searchSubCategory" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-label for="searchDescription" value="{{ __('Descripción') }}" />
                            <x-input id="searchDescription" type="text" class="mt-1 block w-full"
                                wire:model.live.debounce.250ms="searchDescription" />
                        </div>
                    </div>
                    @if ($servicios->count())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-1 py-2 text-left font-medium text-gray-500 uppercase ">
                                        {{ __('Denominacion') }}
                                    </th>
                                    @if ($user->hasRole('admin'))
                                        <th scope="col"
                                            class="px-1 py-2 text-left font-medium text-gray-500 uppercase ">
                                            {{ __('Categoría') }}
                                        </th>
                                        <th scope="col"
                                            class="px-1 py-2 text-left font-medium text-gray-500 uppercase ">
                                            {{ __('Subategoría') }}
                                        </th>
                                    @endif
                                    <th scope="col" class="px-1 py-2 text-left font-medium text-gray-500 uppercase ">
                                        {{ __('Descripción') }}
                                    </th>
                                    <th scope="col" class="px-1 py-2 text-left font-medium text-gray-500 uppercase ">
                                        {{ __('Precio') }}
                                    </th>
                                    <th scope="col" class="px-1 py-2 text-left font-medium text-gray-500 uppercase ">
                                        {{ __('Hab.') }}
                                    </th>
                                    <th scope="col" class="px-1 py-2 text-left font-medium text-gray-500 uppercase ">
                                        {{ __('Acciones') }}
                                    </th>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($servicios as $servicio)
                                    <tr>
                                        <td class="px-1 py-2 whitespace-nowrap">
                                            {{ $servicio->nom_ser }}
                                        </td>
                                        @if ($user->hasRole('admin'))
                                            <td class="px-1 py-2 whitespace-nowrap">
                                                {{ $servicio->cat_ser }}
                                            </td>
                                            <td class="px-1 py-2 whitespace-nowrap">
                                                {{ $servicio->sub_cat }}
                                            </td>
                                        @endif
                                        <td class="px-1 py-2 max-w-60 whitespace-wrap">
                                            {{ $servicio->des_ser }}
                                        </td>
                                        <td class="px-1 py-2 whitespace-wrap">
                                            {{ $servicio->precio }}
                                        </td>
                                        <td class="px-1 py-2 whitespace-nowrap">
                                            <input type="radio" disabled checked
                                                class="{{ $servicio->hab_ser == '1' ? 'text-green-500' : 'text-red-500' }}">
                                        </td>
                                        <td class="px-1 py-4 whitespace-nowrap text-sm font-medium">
                                            <a wire:navigate href="{{ route('servicios.show', $servicio->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a wire:navigate href="{{ route('servicios.edit', $servicio->id) }}"
                                                class="text-yellow-600 hover:text-yellow-900" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('servicios.destroy', $servicio->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900"
                                                    title="Borrar"
                                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este servicio?');">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    {{ $servicios->links() }}
                    @if ($user->hasRole('admin'))
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                <a wire:navigate href="{{ route('servicios.create') }}">
                                    {{ __('Crear servicio') }}
                                </a>
                            </x-button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
