<div>
    <x-slot name="header">        
        <x-header bold='true'>
            {{ __('Lista de Empresas') }}
        </x-header>
    </x-slot>

        <x-container>
                    @if (Auth::user()->hasRole('admin'))
                        <x-search-user></x-search-user>
                        <x-search-empresa></x-search-empresa>
                    @endif

                    @if (session()->has('message'))
                        <x-alert-success> {{ session('message') }} </x-alert-success>
                    @endif

                    @if ($empresas->count())

                    
                    <livewire:tablas.tabla-de-empresas />
                    
                        @can('empresas.create')
                            <div class="buttons-container">
                                <x-cards.card-button route="empresas.create">{{ __('Crear otra empresa')}} </x-cards.card-button>
                            </div>
                        @endcan
                    @else
                        <!-- En caso que todavía no haya ninguna empresa creada -->
                            <div class="buttons-container">
                                <h2>Creá la ficha de tu empresa y empezá a contratar nuestros servicios!</h2>
                                @can('empresas.create')
                                    <x-cards.card-button route="empresas.create">{{ __('Crear empresa')}} </x-cards.card-button>
                                @endcan
                            </div>
                        </div>
                    @endif



        </x-container>
</div>
