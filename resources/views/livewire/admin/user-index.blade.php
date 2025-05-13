<div>
    <x-slot name="header">
        <x-header bold='true'>
            {{ __('Usuarios') }}
        </x-header>
    </x-slot>

    <x-container>
                    <section id="messages">
                        @livewire('alerts.success-error')
                    </section>

                    @livewire('buscadores.buscador-de-usuarios')

                    @livewire('tablas.tabla-de-usuarios')
    </x-container>
</div>
