<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
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
                        <div class="grid grid-cols-1 md:grid md:grid-cols-12 md:gap-3">
                            <!-- Denominación del servicio -->
                            <div class="col-span-12 sm:col-span-4">
                                <x-label for="nom_ser" value="{{ __('Denominación del servicio') }}" />
                                <x-input id="nom_ser" type="text" wire:model="servicio.nom_ser"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    disabled />
                            </div>

                            <!-- Descripción -->
                            <div class="col-span-12 sm:col-span-8">
                                <x-label for="des_ser" value="{{ __('Descripción') }}" />
                                <textarea id="des_ser" wire:model="servicio.des_ser"
                                    class="block mt-1 w-full pl-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    disabled></textarea>
                            </div>

                            <!-- Categoría -->
                            <div class="col-span-12 sm:col-span-1">
                                <x-label for="cat_ser" value="{{ __('Categoría') }}" />
                                <x-input id="cat_ser" type="text" wire:model="servicio.cat_ser"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    disabled />
                            </div>

                            <!-- Subcategoría -->
                            <div class="col-span-12 sm:col-span-1">
                                <x-label for="sub_cat" value="{{ __('Subcategoría') }}" />
                                <x-input id="sub_cat" type="text" wire:model="servicio.sub_cat"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    disabled />
                            </div>

                            <!-- Precio -->
                            <div class="col-span-12 sm:col-span-1">
                                <x-label for="precio" value="{{ __('Precio') }}" />
                                <x-input id="precio" type="number" wire:model="servicio.precio" step="500"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    disabled />
                            </div>

                            <!-- Habilitado -->
                            <div class="col-span-12 sm:col-span-1">
                                <x-label class="mr-2" for="hab_ser" value="{{ __('Habilitado') }}" />
                                <x-input id="hab_ser" type="text" value="{{ $this->habilita_display }}"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    disabled />
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-end px-4 py-3 bg-gray-50 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                        @if (Auth::user()->hasRole('admin'))
                            <a wire:navigate href="{{ route('servicios.edit', $servicio['id']) }}"
                                class="text-yellow-600 hover:text-yellow-900 ml-4" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('servicios.destroy', $servicio['id']) }}" method="POST"
                                class="inline ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Borrar"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta servicio?');">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            <x-button class="ml-4">
                                <a wire:navigate href="{{ route('servicios.index') }}">
                                    {{ __('Volver') }}
                                </a>
                            </x-button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
