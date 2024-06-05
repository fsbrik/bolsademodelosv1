<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Empresas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @foreach($empresas as $empresa)
                    <ul>
                        <li>{{ $empresa->user->name }}</li>
                        <li>{{ $empresa->user->telefono }}</li>
                        <br>
                        <li>{{ $empresa->nom_com }}</li>
                        <li>{{ $empresa->domicilio }}</li>
                        <li>{{ $empresa->rubro }}</li>
                    </ul>
                    <br>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>