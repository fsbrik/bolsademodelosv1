<x-app-layout>
    <x-slot name="header">
        <x-header bold="true">{{ "Empresa ".$empresa->nom_com }}</x-header>
    </x-slot>
    <x-container>
        @if (Auth::user()->hasRole('admin'))
            @livewire('users.user-show', ['userId' => $empresa->user->id])
            <x-section-border />        
        @endif

        @livewire('empresas.empresa-show', ['empresaId' => $empresa->id])
            
    </x-container>
</x-app-layout>
