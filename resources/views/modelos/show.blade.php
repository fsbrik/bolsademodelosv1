<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ficha técnica') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (Auth::user()->hasRole('admin'))
                        @livewire('Admin.modelo-user', ['modeloId' => $modelo->id])
                        <x-section-border />
                    @endif

                    @livewire('modelo-show', ['modeloId' => $modelo->id])
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
