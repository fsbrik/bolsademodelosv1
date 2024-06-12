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

                        <!-- Campo oculto para enviar user_id -->
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        <!-- Fecha de Nacimiento -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="fec_nac" value="{{ __('Fecha de Nacimiento') }}" />
                            <x-input id="fec_nac" class="block mt-1 w-full" type="date" name="fec_nac" :value="old('fec_nac')" autofocus />
                            <x-input-error for="fec_nac" class="mt-2" />
                        </div>

                        <!-- Sexo -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="sexo" value="{{ __('Sexo') }}" />
                            <select id="sexo" name="sexo"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
                                <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                            </select>
                            <x-input-error for="sexo" class="mt-2" />
                        </div>

                        <!-- Estatura -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="estatura" value="{{ __('Estatura') }}" />
                            <x-input id="estatura" class="block mt-1 w-full" type="number" name="estatura"
                                :value="old('estatura')" step="0.01" />
                            <x-input-error for="estatura" class="mt-2" />
                        </div>

                        <!-- Medidas -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="medidas" value="{{ __('Medidas') }}" />
                            <x-input id="medidas" class="block mt-1 w-full" type="text" name="medidas"
                                :value="old('medidas')" />
                            <x-input-error for="medidas" class="mt-2" />
                        </div>

                        <!-- Calzado -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="calzado" value="{{ __('Calzado') }}" />
                            <x-input id="calzado" class="block mt-1 w-full" type="number" name="calzado"
                                :value="old('calzado')" step="0.5" />
                            <x-input-error for="calzado" class="mt-2" />
                        </div>

                        <!-- Zona de Residencia -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="zon_res" value="{{ __('Zona de Residencia') }}" />
                            <select id="zon_res" name="zon_res"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach ($localidades as $localidad)
                                    <option value="{{ $localidad }}"
                                        {{ old('zon_res') == $localidad ? 'selected' : '' }}>{{ __($localidad) }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error for="zon_res" class="mt-2" />
                        </div>

                        <!-- Disponibilidad para viajar -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="dis_via" value="{{ __('Disponibilidad para Viajar') }}" />
                            <select id="dis_via" name="dis_via"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="1" {{ old('dis_via') == '1' ? 'selected' : '' }}>
                                    {{ __('Sí') }}</option>
                                <option value="0" {{ old('dis_via') == '0' ? 'selected' : '' }}>
                                    {{ __('No') }}</option>
                            </select>
                            <x-input-error for="dis_via" class="mt-2" />
                        </div>

                        <!-- Título de Modelo -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="tit_mod" value="{{ __('Título de Modelo') }}" />
                            <select id="tit_mod" name="tit_mod"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="1" {{ old('tit_mod') == '1' ? 'selected' : '' }}>
                                    {{ __('Sí') }}</option>
                                <option value="0" {{ old('tit_mod') == '0' ? 'selected' : '' }}>
                                    {{ __('No') }}</option>
                            </select>
                            <x-input-error for="tit_mod" class="mt-2" />
                        </div>

                        <!-- Nivel de inglés -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="ingles" value="{{ __('Nivel de Inglés') }}" />
                            <select id="ingles" name="ingles"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="basico" {{ old('ingles') == 'basico' ? 'selected' : '' }}>Básico
                                </option>
                                <option value="intermedio" {{ old('ingles') == 'intermedio' ? 'selected' : '' }}>
                                    Intermedio</option>
                                <option value="avanzado" {{ old('ingles') == 'avanzado' ? 'selected' : '' }}>Avanzado
                                </option>
                            </select>
                            <x-input-error for="ingles" class="mt-2" />
                        </div>

                        <!-- Disponible para trabajos -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="dis_tra" value="{{ __('Disponible para trabajos de:') }}" />
                            <select id="dis_tra" name="dis_tra"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="modelo" {{ old('dis_tra') == 'modelo' ? 'selected' : '' }}>Modelo</option>
                                <option value="promotor/a" {{ old('dis_tra') == 'promotor/a' ? 'selected' : '' }}>Promotor/a</option>
                                <option value="ambos" {{ old('dis_tra') == 'ambos' ? 'selected' : '' }}>Ambos</option>
                            </select>
                            <x-input-error for="dis_tra" class="mt-2" />
                        </div>

                        <!-- Descripción -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="descripcion" value="{{ __('Descripción') }}" />
                            <textarea id="descripcion" name="descripcion"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                rows="6">{{ old('descripcion') }}</textarea>
                            <x-input-error for="descripcion" class="mt-2" />
                        </div>

                        <!-- Tarifa por media jornada -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="tar_med" value="{{ __('Tarifa por media jornada') }}" />
                            <x-input id="tar_med" class="block mt-1 w-full" type="number" name="tar_med"
                                :value="old('tar_med')" step="0.01" />
                            <x-input-error for="tar_med" class="mt-2" />
                        </div>

                        <!-- Tarifa por jornada completa -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="tar_com" value="{{ __('Tarifa por jornada completa') }}" />
                            <x-input id="tar_com" class="block mt-1 w-full" type="number" name="tar_com"
                                :value="old('tar_com')" step="0.01" />
                            <x-input-error for="tar_com" class="mt-2" />
                        </div>

                        <!-- Estado -->
                        <div class="col-span-6 sm:col-span-4">
                            <div class="col-span-6 sm:col-span-4 flex items-center">
                                <x-label class="mr-2" for="estado" value="{{ __('Activo / Inactivo') }}" />
                                <select id="estado" name="estado"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>
                                        {{ __('Activo') }}</option>
                                    <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>
                                        {{ __('Inactivo') }}</option>
                                </select>
                            </div>
                            <x-input-error for="estado" class="mt-2" />
                        </div>

                        <!-- Habilitar -->
                        <div class="col-span-6 sm:col-span-4">
                            <div class="col-span-6 sm:col-span-4 flex items-center">
                                <x-label class="mr-2" for="habilita" value="{{ __('Habilitado / Inhabilitado') }}" />
                                <select id="habilita" name="habilita"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="0" {{ old('habilita') == '0' ? 'selected' : '' }}>
                                        {{ __('Inhabilitado') }}</option>
                                    <option value="1" {{ old('habilita') == '1' ? 'selected' : '' }}>
                                        {{ __('Habilitado') }}</option>
                                </select>
                            </div>
                            <x-input-error for="habilita" class="mt-2" />
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
