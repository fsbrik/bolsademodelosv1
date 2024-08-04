<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inscripción de Empresas') }}
        </h2>
    </x-slot>
    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="py-12">
            <div class="max-w-2xl sm:max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                            <form wire:submit="store">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid md:grid-cols-12 sm:gap-3">

                                <!-- Tipo -->
                                <div class="col-span-12 sm:col-span-1">
                                    <x-label for="tipo" value="{{ __('Tipo') }}" />
                                    <select id="tipo" {{-- name="tipo" :value="old('tipo')" --}} wire:model="tipo"
                                        class="block mt-1 w-full pl-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="A">{{ __('A') }}</option>
                                        <option value="C">{{ __('C') }}</option>
                                    </select>
                                    <x-input-error for="tipo" class="mt-2" />
                                </div>

                                <!-- Cuit -->
                                <div class="col-span-12 sm:col-span-2">
                                    <x-label for="cuit" value="{{ __('CUIT') }}" />
                                    <x-input id="cuit" {{-- name="cuit" :value="old('cuit')" --}} wire:model="cuit"
                                    class="mt-1 block w-full" type="text"  />
                                    <x-input-error for="cuit" class="mt-2" />
                                </div>

                                <!-- Rubro -->
                                <div class="col-span-12 sm:col-span-9">
                                    <x-label for="rubro" value="{{ __('Rubro') }}" />
                                    <x-input id="rubro" {{-- name="rubro" :value="old('rubro')" --}} wire:model="rubro"
                                    class="block mt-1 w-full sm:w-1/5" type="text" />
                                    <x-input-error for="rubro" class="mt-2" />
                                </div>

                                <!-- Nombre Comercial -->
                                <div class="col-span-12 sm:col-span-4">
                                    <x-label for="nom_com" value="{{ __('Nombre Comercial') }}" />
                                    <x-input id="nom_com" {{-- name="nom_com" :value="old('nom_com')" --}} wire:model="nom_com"
                                    class="block mt-1 w-full" type="text" />
                                    <x-input-error for="nom_com" class="mt-2" />
                                </div>

                                <!-- Domicilio -->
                                <div class="col-span-12 sm:col-span-8">
                                    <x-label for="domicilio" value="{{ __('Domicilio') }}" />
                                    <x-input id="domicilio" {{-- name="domicilio" :value="old('domicilio')" --}} wire:model="domicilio"
                                    class="block mt-1 w-full" type="text" />
                                    <x-input-error for="domicilio" class="mt-2" />
                                </div>
                            </div>

                            @can('empresas.create')
                                <div class="flex items-center justify-end mt-4">
                                    <x-button class="ml-4">
                                        {{ __('Inscribir Empresa') }}
                                    </x-button>
                                </div>
                            @endcan
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    