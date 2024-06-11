<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles de la modelo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @livewire('Admin.show-user-modelo', ['modeloId' => $modelo->id])
                    <x-section-border />

                    @livewire('edit-info-modelo', ['modeloId' => $modelo->id])
                    <x-section-border />
                       
                    <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                <a href="{{ route('modelos.index') }}">
                                    {{ __('Volver') }}
                                </a>
                            </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
