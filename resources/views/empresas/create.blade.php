<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inscripción de Empresas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('empresas.store') }}">
                        @csrf

                        <x-app-layout>
                            <x-slot name="header">
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ __('Inscripción de Empresas') }}
                                </h2>
                            </x-slot>

                            <div class="py-12">
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                        <div class="p-6 bg-white border-b border-gray-200">
                                            <form method="POST" action="{{ route('empresas.store') }}">
                                                @csrf

                                                <!-- Campo oculto para enviar user_id -->
                                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                                                <!-- Nombre Comercial -->
                                                <div>
                                                    <x-label for="nom_com" value="{{ __('Nombre Comercial') }}" />
                                                    <x-input id="nom_com" class="block mt-1 w-full" type="text"
                                                        name="nom_com" :value="old('nom_com')" required autofocus />
                                                </div>

                                                <!-- Domicilio -->
                                                <div class="mt-4">
                                                    <x-label for="domicilio" value="{{ __('Domicilio') }}" />
                                                    <x-input id="domicilio" class="block mt-1 w-full" type="text"
                                                        name="domicilio" :value="old('domicilio')" required />
                                                </div>

                                                <!-- Rubro -->
                                                <div class="mt-4">
                                                    <x-label for="rubro" value="{{ __('Rubro') }}" />
                                                    <x-input id="rubro" class="block mt-1 w-full" type="text"
                                                        name="rubro" :value="old('rubro')" required />
                                                </div>

                                                <div class="flex items-center justify-end mt-4">
                                                    <x-button class="ml-4">
                                                        {{ __('Inscribir Empresa') }}
                                                    </x-button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-app-layout>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
