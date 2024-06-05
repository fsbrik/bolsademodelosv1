<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modelos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @foreach($modelos as $modelo)
                    <ul>
                        <li>{{ $modelo->user->name }}</li>
                        <li>{{ $modelo->user->telefono }}</li>
                        <br>
                        <li>{{ $modelo->mod_id }}</li>
                        <li>{{ $modelo->fec_nac }}</li>
                        <li>{{ $modelo->sexo }}</li>
                        <li>{{ $modelo->estatura }}</li>
                        <li>{{ $modelo->medidas }}</li>
                        <li>{{ $modelo->calzado }}</li>
                        <li>{{ $modelo->zon_res }}</li>
                        <li>{{ $modelo->dis_via }}</li>
                        <li>{{ $modelo->tit_mod }}</li>
                    </ul>
                    <br>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>