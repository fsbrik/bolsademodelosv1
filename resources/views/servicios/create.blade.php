<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear nuevo servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('servicios.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid md:grid-cols-12 md:gap-3">
                            <!-- Denominación del servicio -->
                            <div class="col-span-12 sm:col-span-4">
                                <x-label for="nom_ser" value="{{ __('Denominación del servicio') }}" />
                                <x-input id="nom_ser" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                type="text" name="nom_ser" :value="old('nom_ser')" autofocus />
                                <x-input-error for="nom_ser" class="mt-2" />
                            </div>

                            <!-- Descripción -->
                            <div class="col-span-12 sm:col-span-8">
                                <x-label for="des_ser" value="{{ __('Descripción') }}" />
                                <textarea id="des_ser" name="des_ser"
                                    class="block mt-1 w-full pl-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('des_ser') }}</textarea>
                                <x-input-error for="des_ser" class="mt-2" />
                            </div>

                            <!-- Categoría -->
                            <div class="col-span-12 sm:col-span-1">
                                <x-label for="cat_ser" value="{{ __('Categoría') }}" />
                                <select id="cat_ser" name="cat_ser"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="modelo" {{ old('cat_ser') == 'modelo' ? 'selected' : '' }}>{{ __('Modelo') }}</option>
                                    <option value="empresa" {{ old('cat_ser') == 'empresa' ? 'selected' : '' }}>{{ __('Empresa') }}</option>
                                </select>
                                <x-input-error for="cat_ser" class="mt-2" />
                            </div>

                            <!-- Precio -->
                            <div class="col-span-12 sm:col-span-1">
                                <x-label for="precio" value="{{ __('Precio') }}" />
                                <x-input id="precio" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                type="number" name="precio" :value="old('precio')" step="500" />
                                <x-input-error for="precio" class="mt-2" />
                            </div>

                            <!-- Habilitar -->
                            <div class="col-span-12 sm:col-span-1">
                                <x-label class="mr-2" for="hab_ser" value="{{ __('Habilitar') }}" />
                                <select id="hab_ser" name="hab_ser"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="0" {{ old('hab_ser') == '0' ? 'selected' : '' }}>
                                        {{ __('Inhabilitado') }}</option>
                                    <option value="1" {{ old('hab_ser') == '1' ? 'selected' : '' }}>
                                        {{ __('Habilitado') }}</option>
                                </select>
                                <x-input-error for="hab_ser" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Crear servicio') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
