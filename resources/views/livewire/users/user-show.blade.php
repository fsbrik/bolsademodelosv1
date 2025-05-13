<div>
    <section id="messages">
        @livewire('alerts.success-error')
    </section>

    {{-- carga el formulario con los datos de la empresa --}}
    @livewire('forms.campos-usuarios', ['userId' => $user->id, 'disabled' => 'disabled', 'tipoDeRuta' => 'show'])

</div>
