<x-app-layout>
    <x-slot name="header">
        <x-header bold="true">{{ __('Información comercial') }}</x-header>
    </x-slot>

    <x-container>
        @if (Auth::user()->hasRole('admin'))
            @livewire('Admin.empresa-user', ['empresaId' => $empresa->id])
            <x-section-border />
        @endif

        @livewire('empresa-edit', ['empresaId' => $empresa->id])
            <x-section-border />
    </x-container>
</x-app-layout>
