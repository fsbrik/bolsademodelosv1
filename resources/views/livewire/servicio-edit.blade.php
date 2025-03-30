<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form wire:submit.prevent="submit">
                        @csrf
                        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                            <div class="grid grid-cols-1 md:grid md:grid-cols-12 md:gap-3">
                                
                                <!-- Denominación del servicio -->
                                <div class="col-span-12 sm:col-span-4">
                                    <x-label for="nom_ser" value="{{ __('Denominación del servicio') }}" />
                                    <x-input id="nom_ser"
                                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        type="text" wire:model="nom_ser" autofocus />
                                </div>

                                <!-- Descripción -->
                                <div class="col-span-12 sm:col-span-8">
                                    <x-label for="des_ser" value="{{ __('Descripción') }}" />
                                    <textarea id="des_ser" wire:model="des_ser"
                                        class="block mt-1 w-full pl-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                </div>

                                <!-- Categoría -->
                                <div class="col-span-12 sm:col-span-1">
                                    <x-label for="cat_ser" value="{{ __('Categoría') }}" />
                                    <select id="cat_ser" wire:model="cat_ser"
                                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="modelo">{{ __('Modelo') }}</option>
                                        <option value="empresa">{{ __('Empresa') }}</option>
                                    </select>
                                </div>

                                <!-- Subcategoría -->
                                <div class="col-span-12 sm:col-span-1">
                                    <x-label for="sub_cat" value="{{ __('Subcategoría') }}" />
                                    <select id="sub_cat" wire:model="sub_cat"
                                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="" >{{ __('-') }}</option>
                                        <option value="reservas">{{ __('Reservas') }}</option>
                                        <option value="planes">{{ __('Planes') }}</option>
                                    </select>
                                </div>

                                <!-- Precio -->
                                <div class="col-span-12 sm:col-span-1">
                                    <x-label for="precio" value="{{ __('Precio') }}" />
                                    <x-input id="precio"
                                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        type="number" wire:model="precio" step="500" />
                                </div>

                                <!-- Habilitar -->
                                <div class="col-span-12 sm:col-span-1">
                                    <x-label class="mr-2" for="hab_ser" value="{{ __('Habilitar') }}" />
                                    <select id="hab_ser" wire:model="hab_ser"
                                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="0">{{ __('Inhabilitado') }}</option>
                                        <option value="1">{{ __('Habilitado') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        @if (Auth::user()->hasRole('admin'))
                            <div
                                class="flex items-center justify-end px-4 py-3 bg-gray-50 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                                <x-button class="ml-4">
                                    {{ __('Actualizar') }}
                                </x-button>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4">
                                    <a wire:navigate href="{{ route('servicios.index') }}">
                                        {{ __('Volver') }}
                                    </a>
                                </x-button>
                            </div>
                        @endif

                    </form>
                    {{-- Mostrar los mensajes de error --}}
                    <div class="col-span-12 sm:col-span-12">
                        <x-validation-errors></x-validation-errors>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
