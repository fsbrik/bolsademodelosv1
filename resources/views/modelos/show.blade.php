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
                        @livewire('Admin.modelo-user-show', ['modeloId' => $modelo->id])
                    <x-section-border />
                    @endif

                    @livewire('modelo-show', ['modeloId' => $modelo->id])
                    <x-section-border />

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('modelos.edit', $modelo->id) }}"
                            class="text-yellow-600 hover:text-yellow-900 ml-4" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('modelos.destroy', $modelo->id) }}" method="POST" class="inline ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" title="Borrar"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar esta modelo?');">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        @can('modelos.index')
                            <x-button class="ml-4">
                                <a href="{{ route('modelos.index') }}">
                                    {{ __('Volver') }}
                                </a>
                            </x-button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
