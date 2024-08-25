<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inscripción de Modelos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form wire:submit="store">
                    @csrf
                        <div class="grid grid-cols-1 md:grid md:grid-cols-12 md:gap-3">
                            <!-- Fecha de Nacimiento -->
                            <div class="col-span-12 sm:col-span-2">
                                <x-label for="fec_nac" value="{{ __('Fecha de Nacimiento') }}" />
                                <x-input id="fec_nac" wire:model.live="fec_nac"
                                    class="block mt-1 w-2/3 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    type="date" autofocus />
                            </div>

                            <!-- Sexo -->
                            <div class="col-span-12 sm:col-span-1">
                                <x-label for="sexo" value="{{ __('Sexo') }}" />
                                <select id="sexo" wire:model="sexo"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="-">{{ __('-') }}</option>
                                    <option value="F">{{ __('Femenino') }}</option>
                                    <option value="M">{{ __('Masculino') }}</option>
                                </select>
                            </div>

                            <!-- Zona de Residencia -->
                            <div class="col-span-12 sm:col-span-2">
                                <x-label for="zon_res" value="{{ __('Zona de Residencia') }}" />
                                <select id="zon_res" wire:model="zon_res"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach ($localidades as $localidad)
                                        <option value="{{ $localidad }}">{{ __($localidad) }}
                                        </option>
                                    @endforeach
                                </select>                                
                            </div>

                            <!-- Disponibilidad para viajar -->
                            <div class="col-span-12 sm:col-span-2">
                                <x-label for="dis_via" value="{{ __('Disponibilidad para Viajar') }}" />
                                <select id="dis_via" wire:model="dis_via"
                                    class="block mt-1 w-2/3 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    {{-- <option value="-">{{ __('-') }}</option> --}}
                                    <option value="0">{{ __('No') }}</option>
                                    <option value="1">{{ __('Sí') }}</option>                                   
                                </select>                                
                            </div>

                            <!-- Estatura -->
                            <div class="col-span-12 sm:col-span-2">
                                <x-label for="estatura" value="{{ __('Estatura (mts)') }}" />
                                <x-input id="estatura" wire:model="estatura" type="text" placeholder="1.75"
                                class="inline mt-1 w-1/3 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
                            </div>

                            <!-- Color del cabello -->
                            <div class="col-span-12 sm:col-span-2">
                                <x-label for="col_cab" value="{{ __('Color del cabello') }}" />
                                <select id="col_cab" wire:model="col_cab"
                                    class="block mt-1 w-2/3 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option >{{ __('-') }}</option>
                                    <option value="rubio">{{ __('Rubio') }}</option>
                                    <option value="castaño">{{ __('Castaño') }}</option>
                                    <option value="pelirrojo">{{ __('Pelirrojo') }}</option>
                                    <option value="morocho">{{ __('Morocho') }}</option>
                                    <option value="otro">{{ __('Otro') }}</option>
                                </select>
                            </div>

                            <!-- Medidas -->
                            <div class="col-span-12 sm:col-span-1">
                                <x-label for="medidas" value="{{ __('Medidas') }}" />
                                <x-input id="medidas" wire:model="medidas" type="text" placeholder="90-60-90"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>                                    
                            </div>

                            <!-- Calzado -->
                            <div class="col-span-12 sm:col-span-1">
                                <x-label for="calzado" value="{{ __('Calzado') }}" />
                                <x-input id="calzado" wire:model="calzado" type="number"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>                                                                     
                            </div>

                            <!-- Título de Modelo -->
                            <div class="col-span-12 sm:col-span-2">
                                <x-label for="tit_mod" value="{{ __('Título de Modelo') }}" />
                                <select id="tit_mod" wire:model="tit_mod"
                                    class="block mt-1 w-2/3 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    {{-- <option value="-">{{ __('-') }}</option> --}}                                    
                                    <option value="0">{{ __('No') }}</option>
                                    <option value="1">{{ __('Sí') }}</option>  
                                </select>
                            </div>

                             <!-- Nivel de inglés -->
                            <div class="col-span-12 sm:col-span-2">
                                <x-label for="ingles" value="{{ __('Nivel de Inglés') }}" />
                                <select id="ingles" wire:model="ingles"
                                    class="block mt-1 w-2/3 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="basico">{{ __('Básico') }}</option>
                                    <option value="intermedio">{{ __('Intermedio') }}</option>
                                    <option value="avanzado">{{ __('Avanzado') }}</option>
                                </select>
                                {{-- <x-input-error for="ingles" class="mt-2" /> --}}
                            </div>

                            <!-- Disponible para trabajos -->
                            <div class="col-span-12 sm:col-span-2">
                                <x-label for="dis_tra" value="{{ __('Disponible para trabajos de') }}" />
                                <select id="dis_tra" wire:model="dis_tra"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="modelo">{{ __('Modelo') }}</option>
                                    <option value="promotor/a">{{ __('Promotor/a') }}</option>
                                    <option value="ambos">{{ __('Ambos') }}</option>
                                </select>
                                {{-- <x-input-error for="dis_tra" class="mt-2" /> --}}
                            </div>

                            <!-- Descripción -->
                            <div class="col-span-12 sm:col-span-12">
                                <x-label for="descripcion" value="{{ __('Descripción') }}" />
                                <textarea id="descripcion" wire:model.live="descripcion"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                {{-- <x-input-error for="descripcion" class="mt-2" /> --}}
                            </div>

                            <!-- Tarifa por media jornada -->
                            <div class="col-span-12 sm:col-span-3">
                                <x-label for="tar_med" value="{{ __('Tarifa por media jornada (U$S)') }}" />
                                <x-input id="tar_med" type="number" class="mt-1 block w-1/2" wire:model="tar_med"
                                    step="0.01" />
                                {{-- <x-input-error for="tar_med" class="mt-2" /> --}}
                            </div>

                            <!-- Tarifa por jornada completa -->
                            <div class="col-span-12 sm:col-span-9">
                                <x-label for="tar_com" value="{{ __('Tarifa por jornada completa (U$S)') }}" />
                                <x-input id="tar_com" type="number" class="mt-1 block w-1/6" wire:model="tar_com"
                                    step="0.01" />
                                {{-- <x-input-error for="tar_com" class="mt-2" /> --}}
                            </div>

                            <!-- Estado -->
                            <div class="col-span-12 sm:col-span-2">
                                <x-label for="estado" value="{{ __('Estado') }}" />
                                <select id="estado" wire:model="estado"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">{{ __('Activo') }}</option>
                                    <option value="0">{{ __('Inactivo') }}</option>
                                </select>
                                {{-- <x-input-error for="estado" class="mt-2" /> --}}
                            </div>

                            @if (Auth::user()->hasRole('admin'))
                                <!-- Habilitar -->
                                <div class="col-span-12 sm:col-span-10">
                                    <x-label class="mr-2" for="habilita" value="{{ __('Habilitar') }}" />
                                    <select id="habilita" wire:model="habilita"
                                        class="block mt-1 w-1/6 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="0">{{ __('Inhabilitado') }}</option>
                                        <option value="1">{{ __('Habilitado') }}</option>
                                    </select>
                                    {{-- <x-input-error for="habilita" class="mt-2" /> --}}
                                </div>
                            @endif

                            {{-- Mostrar los mensajes de error --}}
                            <div class="col-span-12 sm:col-span-12">
                                <x-validation-errors></x-validation-errors>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Inscribir') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

