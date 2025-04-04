<div>
    <x-slot name="header">
        <x-header bold="true">{{ __('Inscripción de Empresas') }}</x-header>
    </x-slot>

    <x-container>
        <form wire:submit="store">
            @csrf
            
            <x-campos-empresa />


            @can('empresas.create')
                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        {{ __('Inscribir Empresa') }}
                    </x-button>
                </div>
            @endcan
        </form>

    </x-container>
</div>
</div>
