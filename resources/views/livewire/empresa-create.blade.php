<div>
    <x-slot name="header">
        <x-header bold="true">{{ __('Inscripción de Empresas') }}</x-header>
    </x-slot>

    <x-container>
        <form wire:submit="store">
            @csrf

            <x-campos-empresa />

            @can('empresas.create')
                <div class="buttons-container">
                    <x-cards.card-button route="empresas.index">
                        {{ __('Volver') }}
                    </x-cards.card-button>
                    <x-cards.card-button>
                        {{ __('Inscribir Empresa') }}
                    </x-cards.card-button>
                </div>
            @endcan
        </form>

    </x-container>
</div>

