<div>
    <x-slot name="header">
        <x-header bold='true'>
            {{ __('Habilitar planes') }}
        </x-header>
    </x-slot>

    <x-container>
        {{-- @if (session()->has('successMessage'))
            <x-alert-success> {{ session('successMessage') }} </x-alert-success>
        @endif

        @if (session()->has('errorMessage'))
            <x-alert-error> {{ session('errorMessage') }} </x-alert-error>
        @endif --}}

        <section id="messages">
            @livewire('alerts.success-error')
        </section>
        
        @livewire('buscadores.buscador-de-planes')

        @livewire('tablas.tabla-de-habilitar-planes')

    </x-container>
</div>
