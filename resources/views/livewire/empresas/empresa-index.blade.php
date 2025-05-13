<div>
    <x-slot name="header">
        <x-header bold='true'>
            {{ __('Listado de empresas') }}
        </x-header>
    </x-slot>

    <x-container>

        <section id="messages">
            @livewire('alerts.success-error')
        </section>

        @if (Auth::user()->hasRole('admin'))
            {{-- buscador por datos del usuario --}}
            @livewire('buscadores.buscador-de-usuarios')
        @endif

        {{-- buscador por datos de la empresa --}}
        @livewire('buscadores.buscador-de-empresas')

        @livewire('tablas.tabla-de-empresas')

    </x-container>
</div>
