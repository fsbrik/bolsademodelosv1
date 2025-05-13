<div>
    <x-slot name="header">
        <x-header bold="true">
            {{ __('Plan contratado') }}
        </x-header>
    </x-slot>
    <x-container>
        <section id="messages">
            @livewire('alerts.success-error')
        </section>

        <section class="flex flex-col items-center">

            {{-- <!-- Plan Simple -->
                <div class="flex flex-col self-center w-full sm:w-auto md:w-2/3 lg:w-1/3 {{ $selectedPlan === 'plan simple' ? 'bg-purple-300' : 'hidden' }}
                 rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 mb-5">
                    <div class="flex flex-col flex-grow mx-auto">
                        <h3 class="text-gray-600 text-lg">Plan Simple</h3>
                        <p class="text-gray-600 mt-1"><span class="font-bold text-black text-4xl">$50.000</span> /u.</p>
                        <p class="text-sm text-gray-600 mt-2">Ideal para contrataciones eventuales</p>
                        <div class="flex-grow text-sm text-gray-600 mt-4">
                            <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Incluye 1 contacto efectivo*</p>
                            <p class="my-2 text-xs">*contacto que haya confirmado el trabajo</p>
                        </div>
                        <span class="rounded px-1 w-fit mx-auto mt-2 {{ $this->getEstado() == 'habilitado' ? 'bg-green-500' : 'bg-red-500' }}">Estado: {{ $this->getEstado() }}</span>  
                        <span class="rounded px-1 w-fit mx-auto mt-2 {{ $this->getEstado() == 'habilitado' ? 'bg-yellow-400' : 'hidden' }}">Fecha de inicio: {{ $this->getInicio() }}</span>  
                        <span class="rounded px-1 w-fit mx-auto mt-2 {{ $this->getEstado() == 'habilitado' ? 'bg-yellow-600' : 'hidden' }}">Vencimiento: {{ $this->getVencimiento() }}</span>  
                    </div>
                </div> --}}

            {{-- <!-- Plan Mensual -->
                <div class="flex flex-col self-center w-full sm:w-auto md:w-2/3 lg:w-1/3 {{ $selectedPlan === 'plan mensual' ? 'bg-purple-300' : 'hidden' }}
                    rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 mb-5">
                    <div class="flex flex-col flex-grow mx-auto">
                        <h3 class="text-gray-600 text-lg">Plan mensual</h3>
                        <p class="text-gray-600 mt-1"><span class="font-bold text-black text-4xl">$175.000</span> /30
                            días</p>
                        <p class="text-sm text-gray-600 mt-2">Ideal para pequeñas empresas</p>
                        <p class="text-sm text-gray-600">Ideal por cambio de temporada</p>
                        <div class="text-sm text-gray-600 mt-4">
                            <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Incluye hasta 5
                                contactos efectivos*</p>
                            <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Duración: 30 días</p>
                            <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Ahorro: 30%*</p>
                            <p class="my-2 fa-xs">*comparado con 5 planes simples</p>
                        </div>
                        <span class="rounded px-1 w-fit mx-auto mt-2 {{ $this->getEstado() == 'habilitado' ? 'bg-green-500' : 'bg-red-500' }}">Estado: {{ $this->getEstado() }}</span>  
                        <span class="rounded px-1 w-fit mx-auto mt-2 {{ $this->getEstado() == 'habilitado' ? 'bg-yellow-400' : 'hidden' }}">Fecha de inicio: {{ $this->getInicio() }}</span>  
                        <span class="rounded px-1 w-fit mx-auto mt-2 {{ $this->getEstado() == 'habilitado' ? 'bg-yellow-600' : 'hidden' }}">Vencimiento: {{ $this->getVencimiento() }}</span>  
                    </div>
                </div> --}}

            {{-- <!-- Plan Anual (Full) -->
                <div class="flex flex-col self-center w-full sm:w-auto md:w-2/3 lg:w-1/3 {{ $selectedPlan === 'plan anual' ? 'bg-purple-300' : 'hidden' }}
                    rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 mb-5">
                    <div class="flex flex-col flex-grow mx-auto">
                        <h3 class="text-gray-600 text-lg">Plan anual (full)</h3>
                        <p class="text-gray-600 mt-1"><span class="font-bold text-black text-4xl">$1.470.000</span> /365
                            días</p>
                        <p class="text-sm text-gray-600 mt-2">Ideal para grandes empresas</p>
                        <p class="text-sm text-gray-600">Ideal para alta demanda de personal</p>
                        <div class="text-sm text-gray-600 mt-4">
                            <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Incluye contactos
                                ilimitados</p>
                            <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Duración: 365 días</p>
                            <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Ahorro: 30%*</p>
                            <p class="my-2 fa-xs">*comparado con 12 planes mensuales</p>
                        </div> 
                        <span class="rounded px-1 w-fit mx-auto mt-2 {{ $this->getEstado() == 'habilitado' ? 'bg-green-500' : 'bg-red-500' }}">Estado: {{ $this->getEstado() }}</span>  
                        <span class="rounded px-1 w-fit mx-auto mt-2 {{ $this->getEstado() == 'habilitado' ? 'bg-yellow-400' : 'hidden' }}">Fecha de inicio: {{ $this->getInicio() }}</span>  
                        <span class="rounded px-1 w-fit mx-auto mt-2 {{ $this->getEstado() == 'habilitado' ? 'bg-yellow-600' : 'hidden' }}">Vencimiento: {{ $this->getVencimiento() }}</span>  
                    </div>
                </div> --}}
            <x-cards.card-plan-show nombre="Plan Simple" precio="$50.000" unidad="/u."
                descripcion-corta="Ideal para contrataciones eventuales" :descripcion-larga="['Incluye 1 contacto efectivo*', '*contacto que haya confirmado el trabajo']" :selected-plan="$selectedPlan"
                nombre-interno="plan simple" :getHabilita="$this->getHabilita" :estado="$this->habilita" :fec_ini="$this->fec_ini" :fec_fin="$this->fec_fin"/>

            <x-cards.card-plan-show nombre="Plan mensual" precio="$175.000" unidad="/30 días"
                descripcion-corta="Ideal para pequeñas empresas" :descripcion-larga="[
                    'Incluye hasta 5 contactos efectivos*',
                    'Duración: 30 días',
                    'Ahorro: 30%*',
                    '*comparado con 5 planes simples',
                ]" :selected-plan="$selectedPlan"
                nombre-interno="plan mensual" :getHabilita="$this->getHabilita" :estado="$this->habilita" :fec_ini="$this->fec_ini" :fec_fin="$this->fec_fin"/>

            <x-cards.card-plan-show nombre="Plan anual (full)" precio="$1.470.000" unidad="/365 días"
                descripcion-corta="Ideal para grandes empresas" :descripcion-larga="[
                    'Incluye contactos ilimitados',
                    'Duración: 365 días',
                    'Ahorro: 30%*',
                    '*comparado con 12 planes mensuales',
                ]" :selected-plan="$selectedPlan"
                nombre-interno="plan anual" :getHabilita="$this->getHabilita" :estado="$this->habilita" :fec_ini="$this->fec_ini" :fec_fin="$this->fec_fin"/>
        <div class="buttons-container mt-4">
            <x-cards.button-a route="planes.index">
                Volver
            </x-cards.button-a>
        </div>
    </section>
    </x-container>
</div>
