<div>
    <x-slot name="header">
        <x-header bold='true'>
            {{ __('Crear empresa') }}
        </x-header>
    </x-slot>
    <x-container>
        <section id="messages">
            @livewire('alerts.success-error')
        </section>

        @if (Auth::user()->hasRole('admin'))
            {{-- buscador por datos del usuario --}}
            @livewire('buscadores.buscador-de-usuarios')
            @livewire('tablas.seleccionador-de-usuario')
        @endif


        {{-- carga el formulario para cargar una empresa --}}
        @livewire('forms.campos-empresa-create')

    </x-container>
</div>
