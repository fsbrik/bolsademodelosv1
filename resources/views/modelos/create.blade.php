<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inscripción de Modelos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('modelos.store') }}">
                        @csrf

                        <!-- Fecha de Nacimiento -->
                        <div>
                            <x-label for="fec_nac" value="{{ __('Fecha de Nacimiento') }}" />
                            <x-input id="fec_nac" class="block mt-1 w-full" type="date" name="fec_nac" :value="old('fec_nac')" required autofocus />
                        </div>

                        <!-- Sexo -->
                        <div class="mt-4">
                            <x-label for="sexo" value="{{ __('Sexo') }}" />
                            <select id="sexo" name="sexo" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>

                        <!-- Estatura -->
                        <div class="mt-4">
                            <x-label for="estatura" value="{{ __('Estatura') }}" />
                            <x-input id="estatura" class="block mt-1 w-full" type="number" name="estatura" :value="old('estatura')" step="0.01" />
                        </div>

                        <!-- Medidas -->
                        <div class="mt-4">
                            <x-label for="medidas" value="{{ __('Medidas') }}" />
                            <x-input id="medidas" class="block mt-1 w-full" type="text" name="medidas" :value="old('medidas')" />
                        </div>

                        <!-- Calzado -->
                        <div class="mt-4">
                            <x-label for="calzado" value="{{ __('Calzado') }}" />
                            <x-input id="calzado" class="block mt-1 w-full" type="text" name="calzado" :value="old('calzado')" />
                        </div>

                        <!-- Zona de Residencia -->
                        <div class="mt-4">
                            <x-label for="zon_res" value="{{ __('Zona de Residencia') }}" />
                            <x-input id="zon_res" class="block mt-1 w-full" type="text" name="zon_res" :value="old('zon_res')" />
                        </div>

                        <!-- Disponibilidad para viajar -->
                        <div class="mt-4">
                            <x-label for="dis_via" value="{{ __('Disponibilidad para Viajar') }}" />
                            <x-input id="dis_via" class="block mt-1" type="checkbox" name="dis_via" :value="old('dis_via')" />
                        </div>

                        <!-- Título de Modelo -->
                        <div class="mt-4">
                            <x-label for="tit_mod" value="{{ __('Título de Modelo') }}" />
                            <x-input id="tit_mod" class="block mt-1" type="checkbox" name="tit_mod" :value="old('tit_mod')" />
                        </div>

                        <!-- Nivel de inglés -->
                        <div class="mt-4">
                            <x-label for="ingles" value="{{ __('Nivel de Inglés') }}" />
                            <select id="ingles" name="ingles" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="basico">Básico</option>
                                <option value="intermedio">Intermedio</option>
                                <option value="avanzado">Avanzado</option>
                            </select>
                        </div>

                        <!-- Descripción -->
                        <div class="mt-4">
                            <x-label for="descripcion" value="{{ __('Descripción') }}" />
                            <textarea id="descripcion" name="descripcion" class="block mt-1 w-full" rows="6">{{ old('descripcion') }}</textarea>
                        </div>

                        <!-- Tarifa por Medio -->
                        <div class="mt-4">
                            <x-label for="tar_med" value="{{ __('Tarifa por Medio') }}" />
                            <x-input id="tar_med" class="block mt-1 w-full" type="number" name="tar_med" :value="old('tar_med')" step="0.01" />
                        </div>

                        <!-- Tarifa por Comisión -->
                        <div class="mt-4">
                            <x-label for="tar_com" value="{{ __('Tarifa por Comisión') }}" />
                            <x-input id="tar_com" class="block mt-1 w-full" type="number" name="tar_com" :value="old('tar_com')" step="0.01" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Inscribir Modelo') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
