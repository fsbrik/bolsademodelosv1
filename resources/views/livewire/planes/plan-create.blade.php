<div>
    <x-slot name="header">
        <x-header bold='true'>
            {{ __('Planes empresariales') }}
        </x-header>
    </x-slot>
    <x-container>
        <section id="messages">
            @livewire('alerts.success-error')
        </section>

        @if (Auth::user()->hasRole('admin'))
            {{-- @livewire('admin.pedido-user-search') --}}
            {{-- buscador por datos del usuario --}}
            @livewire('tablas.seleccionador-de-usuario-en-planes')
        @endif

        {{-- carga el formulario para cargar una empresa --}}
        @livewire('forms.tarjetas-planes-create')

    </x-container>

    <x-validation-errors></x-validation-errors>
    <div class="container max-w-5xl mx-auto px-6 mt-10">
        {{-- <div class="text-center my-6">
            <h4 class="fa-1x text-gray-600">Cuadro tarifario</h4>
        </div> --}}
        
        {{-- @if (session()->has('selectedUserError'))
            <div x-data="{ open: true }" x-show="open"
                class="relative p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                role="alert">
                <button @click="open = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
                {{ session('selectedUserError') }}
            </div>
        @endif
        @if (Auth::user()->hasRole('admin') && $selectedUser)
            <div class="px-4 py-5 sm:p-6 mb-4 w-full sm:w-1/3 bg-green-400 shadow sm:rounded-lg">
                {{ __('Usuario: ') . $selectedUser['name'] }} <br />
                {{ __('Rol: ') . $selectedUser->roles->first()->name }}
            </div>
        @endif --}}
        
