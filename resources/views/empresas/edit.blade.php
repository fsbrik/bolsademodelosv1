<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Información comercial') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl sm:max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if (Auth::user()->hasRole('admin'))
                        @livewire('Admin.empresa-user', ['empresaId' => $empresa->id])
                        <x-section-border />
                    @endif

                    @livewire('empresa-edit', ['empresaId' => $empresa->id])
                    <x-section-border />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
