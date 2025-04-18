<div>
    <x-campos-empresa />
    <div class="flex items-center justify-end mt-4">
        {{-- <a href="{{ route('empresas.edit', $empresaOriginal->id) }}" class="text-yellow-600 hover:text-yellow-900 ml-4"
            title="Editar">
            <i class="fas fa-edit"></i>
        </a> --}}
        <x-cards.button-edit route="empresas.edit" :param="$empresaOriginal->id" />
            {{-- <form wire:submit="destroy" class="inline ml-4">
                @csrf
            </form> --}}
        <x-cards.button-delete/>
        
        @can('empresas.index')
            <x-cards.card-button route="empresas.index">
                {{ __('Volver') }}
            </x-cards.card-button>
        @endcan
    </div>
</div>
