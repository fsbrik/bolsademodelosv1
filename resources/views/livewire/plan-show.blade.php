<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Plan contratado') }}
        </h2>
    </x-slot>
    <div class="container max-w-5xl mx-auto px-6 mt-10">
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

            <div class="flex flex-col">
                
                <!-- Plan Simple -->
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
                </div>

                <!-- Plan Mensual -->
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
                </div>

                <!-- Plan Anual (Full) -->
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
                </div>
                <a href="{{ route('planes.index')}}"
                class="inline-flex items-center w-fit self-center  px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'">
                Volver</a>
            </div>
    </div>
</div>
