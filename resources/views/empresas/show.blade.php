<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles de la Empresa') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @livewire('Admin.empresa-user-show', ['empresaId' => $empresa->id])
                    <x-section-border />

                    @livewire('empresa-show', ['empresaId' => $empresa->id])
                    <x-section-border />

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('empresas.edit', $empresa->id) }}" class="text-yellow-600 hover:text-yellow-900 ml-4" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST" class="inline ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" title="Borrar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta empresa?');">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        <x-button class="ml-4">
                            <a href="{{ route('empresas.index') }}">
                                {{ __('Volver') }}
                            </a>
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
