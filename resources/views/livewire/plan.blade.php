<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Planes empresariales') }}
        </h2>
    </x-slot>
    <div class="container max-w-5xl mx-auto px-6">
        <div class="text-center my-6">
            <h4 class="fa-1x text-gray-600">Cuadro tarifario</h4>
        </div>
        <div class="flex flex-col lg:flex-row px-2 lg:px-0">
            <!-- Plan Simple -->
            <div class="w-full sm:w-auto md:w-2/3 lg:w-1/3 bg-purple-300 rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 md:mx-auto lg:mr-4 mb-5">
                <div class="h-auto xl:h-80 mx-auto">
                    <h3 class="text-gray-600 text-lg">Plan Simple</h3>
                    <p class="text-gray-600 mt-1"><span class="font-bold text-black text-4xl">$50.000</span> /u.</p>
                    <p class="text-sm text-gray-600 mt-2">Ideal para contrataciones eventuales</p>
                    <div class="text-sm text-gray-600 mt-4">
                        <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span> Incluye 1 contacto efectivo*</p>
                        <p class="my-2 text-xs">*contacto que haya confirmado el trabajo</p>
                    </div>
                </div>
                <button class="w-full text-purple-700 bg-white rounded hover:bg-purple-500 hover:text-white hover:shadow-xl transition duration-150 ease-in-out py-4 mt-4">Seleccionar plan</button>
            </div>

            <!-- Plan Mensual -->
            {{-- <div class="w-full md:w-1/3 text-white bg-purple-700 rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 md:mr-4 mb-10 md:mb-0">
                <div class="h-80">
                    <h3 class="text-lg">Plan mensual</h3>
                    <p class="mt-1"><span class="font-bold text-4xl">$175.000</span> /30 días</p>
                    <p class="text-sm opacity-75 mt-2">Ideal para pequeñas empresas</p>
                    <p class="text-sm opacity-75">Ideal por cambio de temporada</p>
                    <div class="text-sm mt-4">
                        <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Incluye hasta 5 contactos efectivos*</p>
                        <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Duración: 30 días</p>
                        <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Ahorro: 30%</p>
                        <p class="my-2 fa-xs">*contactos que hayan confirmado el trabajo</p>
                    </div>
                </div>
                <button class="w-full text-purple-700 bg-white rounded opacity-75 hover:opacity-100 hover:shadow-xl transition duration-150 ease-in-out py-4 mt-4">Seleccionar plan</button>
            </div> --}}
            <div class="w-full md:w-auto lg:w-1/3 bg-purple-300 rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 md:mx-auto lg:mr-4 mb-5">
                <div class="h-auto xl:h-80 mx-auto">
                    <h3 class="text-gray-600 text-lg">Plan mensual</h3>
                    <p class="text-gray-600 mt-1"><span class="font-bold text-black text-4xl">$175.000</span> /30 días</p>
                    <p class="text-sm text-gray-600 mt-2">Ideal para pequeñas empresas</p>
                    <p class="text-sm text-gray-600">Ideal por cambio de temporada</p>
                    <div class="text-sm text-gray-600 mt-4">
                        <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Incluye hasta 5 contactos efectivos*</p>
                        <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Duración: 30 días</p>
                        <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Contactás directamente sin la intervención de BdM</p>
                        <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span> Duración: 365 días</p>
                        <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span> Ahorro: 30%*</p>
                        <p class="my-2 fa-xs">*comparado con 5 planes simples</p>
                    </div>
                </div>
                <button class="w-full text-purple-700 bg-white rounded hover:bg-purple-500 hover:text-white hover:shadow-xl transition duration-150 ease-in-out py-4 mt-4">Seleccionar plan</button>
            </div>

            <!-- Plan Anual (Full) -->
            <div class="w-full md:w-auto lg:w-1/3 bg-purple-300 rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 md:mx-auto lg:mr-4 mb-5">
                <div class="h-auto xl:h-80 mx-auto">
                    <h3 class="text-gray-600 text-lg">Plan anual (full)</h3>
                    <p class="text-gray-600 mt-1"><span class="font-bold text-black text-4xl">$1.470.000</span> /365 días</p>
                    <p class="text-sm text-gray-600 mt-2">Ideal para grandes empresas</p>
                    <p class="text-sm text-gray-600">Ideal para alta demanda de personal</p>
                    <div class="text-sm text-gray-600 mt-4">
                        <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Incluye contactos ilimitados</p>
                        <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Acceso full a la base de datos sin restricciones</p>
                        <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Contactás directamente sin la intervención de BdM</p>
                        <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span> Duración: 365 días</p>
                        <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span> Ahorro: 30%*</p>
                        <p class="my-2 fa-xs">*comparado con 12 planes mensuales</p>
                    </div>
                </div>
                <button class="w-full text-purple-700 bg-white rounded hover:bg-purple-500 hover:text-white hover:shadow-xl transition duration-150 ease-in-out py-4 mt-4">Seleccionar plan</button>
            </div>
        </div>
    </div>
</div>
