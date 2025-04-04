<x-app-layout>
    <x-slot name="header">
        <x-header bold="true">{{ __('Tu empresa') }}</x-header>
    </x-slot>
    <x-container>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (Auth::user()->hasRole('admin'))
            @livewire('Admin.empresa-user', ['empresaId' => $empresa->id])
            <x-section-border />
        @endif

        @if (session()->has('message'))
            <x-alert-success> {{ session('message') }} </x-alert-success>
        @endif

        @livewire('empresa-show', ['empresaId' => $empresa->id])
            <x-section-border />

    </x-container>

</x-app-layout>
