<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Planes empresariales') }}
        </h2>
    </x-slot>
    @if (Auth::user()->hasRole('admin'))
        @livewire('admin.pedido-user-search')
    @endif
    
    <x-validation-errors></x-validation-errors>
    <div class="container max-w-5xl mx-auto px-6 mt-10">
        {{-- <div class="text-center my-6">
            <h4 class="fa-1x text-gray-600">Cuadro tarifario</h4>
        </div> --}}
            @if (session()->has('message'))
                <div x-data="{ open: true }" x-show="open"
                    class="relative p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                    role="alert">
                    <button @click="open = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                    {{ session('message') }}
                </div>
            @endif
            @if (session()->has('selectedUserError'))
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
            @endif    
            <div class="flex flex-col lg:flex-row px-2 lg:px-0">
    
                <!-- Plan Simple -->
                <div class="flex flex-col w-full sm:w-auto md:w-2/3 lg:w-1/3 {{ $selectedPlan === 'plan simple' ? 'bg-purple-500' : 'bg-purple-300' }}
                 rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 md:mx-auto lg:mr-4 mb-5">
                    <div class="flex flex-col flex-grow mx-auto">
                        <h3 class="text-gray-600 text-lg">Plan Simple</h3>
                        <p class="text-gray-600 mt-1"><span class="font-bold text-black text-4xl">$50.000</span> /u.</p>
                        <p class="text-sm text-gray-600 mt-2">Ideal para contrataciones eventuales</p>
                        <div class="flex-grow text-sm text-gray-600 mt-4">
                            <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Incluye 1 contacto efectivo*</p>
                            <p class="my-2 text-xs">*contacto que haya confirmado el trabajo</p>
                        </div>
                        
                    </div>
                    <button wire:click="selectPlan('plan simple')"
                    class="self-end w-full text-purple-700 bg-white rounded {{ $selectedPlan === 'plan simple' ? '' : 'hover:bg-purple-500 hover:text-white hover:shadow-xl' }} transition duration-150 ease-in-out py-4 mt-4"
                    {{ $selectedPlan === 'plan simple' ? 'disabled' : '' }}>{{ $selectedPlan === 'plan simple' ? 'Plan seleccionado' : 'Seleccionar plan'}}</button>
                </div>

                <!-- Plan Mensual -->
                <div class="flex flex-col w-full md:w-auto lg:w-1/3 {{ $selectedPlan === 'plan mensual' ? 'bg-purple-500' : 'bg-purple-300' }}
                    rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 md:mx-auto lg:mr-4 mb-5">
                    <div class="flex flex-col flex-grow mx-auto">
                        <h3 class="text-gray-600 text-lg">Plan mensual</h3>
                        <p class="text-gray-600 mt-1"><span class="font-bold text-black text-4xl">$175.000</span> /30
                            días</p>
                        <p class="text-sm text-gray-600 mt-2">Ideal para pequeñas empresas</p>
                        <p class="text-sm text-gray-600">Ideal por cambio de temporada</p>
                        <div class="text-sm text-gray-600 mt-4">
                            <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Incluye hasta 5 contactos efectivos*</p>
                            <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Duración: 30 días</p>
                            <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Ahorro: 30%*</p>
                            <p class="my-2 fa-xs">*comparado con 5 planes simples</p>
                        </div>                        
                    </div>
                    <button wire:click="selectPlan('plan mensual')"
                    class="w-full text-purple-700 bg-white rounded {{ $selectedPlan === 'plan mensual' ? '' : 'hover:bg-purple-500 hover:text-white hover:shadow-xl' }} transition duration-150 ease-in-out py-4 mt-4"
                    {{ $selectedPlan === 'plan mensual' ? 'disabled' : '' }}>{{ $selectedPlan === 'plan mensual' ? 'Plan seleccionado' : 'Seleccionar plan'}}</button>
                </div>

                <!-- Plan Anual (Full) -->
                <div class="flex flex-col w-full md:w-auto lg:w-1/3 {{ $selectedPlan === 'plan anual' ? 'bg-purple-500' : 'bg-purple-300' }}
                    rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 md:mx-auto lg:mr-4 mb-5">
                    <div class="flex flex-col flex-grow mx-auto">
                        <h3 class="text-gray-600 text-lg">Plan anual (full)</h3>
                        <p class="text-gray-600 mt-1"><span class="font-bold text-black text-4xl">$1.470.000</span> /365
                            días</p>
                        <p class="text-sm text-gray-600 mt-2">Ideal para grandes empresas</p>
                        <p class="text-sm text-gray-600">Ideal para alta demanda de personal</p>
                        <div class="text-sm text-gray-600 mt-4">
                            <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Incluye contactos ilimitados</p>
                            <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Duración: 365 días</p>
                            <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Ahorro: 30%*</p>
                            <p class="my-2 fa-xs">*comparado con 12 planes mensuales</p>
                        </div>                        
                    </div> 
                    <button wire:click="selectPlan('plan anual')"
                    class="w-full text-purple-700 bg-white rounded {{ $selectedPlan === 'plan anual' ? '' : 'hover:bg-purple-500 hover:text-white hover:shadow-xl' }} transition duration-150 ease-in-out py-4 mt-4"
                    {{ $selectedPlan === 'plan anual' ? 'disabled' : '' }}>{{ $selectedPlan === 'plan anual' ? 'Plan seleccionado' : 'Seleccionar plan'}}</button>                   
                </div>
            </div>
    </div>
</div>
