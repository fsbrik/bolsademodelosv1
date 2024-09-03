<x-app-layout>
    {{-- <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> 
    </x-slot> --}}
    {{-- para tamaño de pantalla a partir de md --}}
    <header
        class="w-full mx-0 sm:mx-auto p-2 pb-0 sm:p-6 mt-6 bg-no-repeat bg-fixed hidden md:flex md:flex-col items-end justify-end"
        style="background-image: url('{{ asset('storage/dashboard/dashboard_quienes_somos_BdM.svg') }}'); background-size: cover;">
        <div class="bg-slate-800 bg-opacity-80 w-3/5 p-20 mr-40">
            <p class="text-justify text-white"><span class="text-xl font-extrabold">Bolsa de
                    modelos</span><x-application-mark></x-application-mark> es el primer portal de trabajos
                en Argentina dedicado exclusivamente a las/los modelos y promotoras. Nos diferenciamos de las típicas
                <span class="underline">agencias de modelos</span>
                en que no te hacemos firmar ningún contrato, lo que te permite trabajar de forma independiente.</p>
            <p class="text-justify text-white">Para resumir, <span class="text-xl font-extrabold">Bolsa de
                    modelos</span><x-application-mark></x-application-mark> es una bolsa de trabajo dedicada
                exclusivamente a las/los modelos y promotoras.</p>
        </div>
        <div class="bg-slate-800 bg-opacity-80 w-2/5 p-20 ml-20 mt-16 mb-40 self-start">
            <h1 class="underline text-xl font-bold text-slate-400 mb-2">Modelos</h1>
            <p class="text-justify text-white mb-2"><span class="text-lg font-bold">Ventajas: </span>Vos organizas tus
                plazos, vos cerrás los trabajos directamente con las empresas, tus honorarios pueden ser mayores a los
                que podés percibir por agencia.</p>
            <p class="text-justify text-white"><span class="text-lg font-bold">Desventajas: </span>Tenés que invertir
                algo de tiempo en aclarar las condiciones del trabajo y tus honorarios.</p>
        </div>
        <div class="bg-slate-800 bg-opacity-80 w-2/5 p-20 mr-20 mb-20 -mt-96 self-end">
            <h1 class="underline text-xl font-bold text-slate-400 mb-2">Empresas</h1>
            <p class="text-justify text-white mb-2"><span class="text-lg font-bold">Ventajas: </span>Pagás mucho menos
                que al contratar una agencia (consultá nuestros <a href="#"
                    class="font-semibold underline text-slate-400">planes</a>). Además, diseñamos un <a
                    href="{{ route('modelos.index') }}" class="font-semibold underline text-slate-400">panel
                    especializado</a> para que puedas encontrar a la/s modelo/s según tus requerimientos.</p>
            <p class="text-justify text-white"><span class="text-lg font-bold">Desventajas: </span>Tenés que organizar
                toda la logística que implica el traslado de las modelos, etc.</p>
        </div>
    </header>
    <section id="como_funciona" class="hidden md:flex md:flex-row">
        <div class="w-full py-32 bg-slate-300">            
                <h3 class="text-gray-600 text-center font-extrabold fa-5x">¿Cómo funciona <span class="font-normal"><x-application-logo></x-application-logo></span>?</h3>
                <p class="mb-14 fa-lg text-center"> Hacemos de intermediario
                    entre las modelos y las empresas...
                </p>
                <div class="w-fit mx-auto mt-36 grid grid-flow-col-dense grid-cols-3 place-items-center">
                    <i class="fa-solid fa-user-tie text-blue-800 text-[12em] row-span-3 justify-self-end"></i>                        
                    <p class="text-center px-4">La empresa genera una propuesta de trabajo</p>                       
                    <i class="fa-duotone fa-solid fa-arrow-right-arrow-left text-green-600 fa-3x"></i>
                    <p class="text-center px-4">Las modelos confirman o rechazan dicha propuesta</p>
                    <i class="fa-solid fa-children text-purple-600 text-[12em] row-span-3 justify-self-start"></i>
                </div>
        </div>
    </section>
    <section id="servicios" class="py-40 px-6 hidden md:flex md:flex-row">
        <div class="w-full  mx-auto flex justify-center items-end">
            {{-- <div class="bg-[length:200px] w-auto h-56 bg-no-repeat bg-bottom bg-slate-500"
                style="background-image: url('{{ asset('storage/dashboard/dashboard_bola_modelo_BdM.svg') }}');"> --}}
            <div class="w-[300px] mb-6 sm:mx-4">
                <h3 class="text-gray-600 font-extrabold text-2xl text-center mb-1 sm:mb-4">Modelos</h3>
                <p class="mb-1 text-sm text-center"><span class="fa fa-check-circle mr-2 ml-1"></span>Quiero
                    incorporarme como modelo!</p>
                <p class="mb-3 text-sm text-center"><span class="fa fa-check-circle mr-2 ml-1"></span>Quiero realizar mi
                    book</p>                
                <a href="{{ route('infomodelos') }}">
                    <img src="{{ asset('storage/dashboard/dashboard_bola_modelo_BdM.svg') }}" class="w-[175px] mx-auto"
                        alt="modelo" /></a>
            </div>
            {{-- <div class="bg-[length:200px] w-auto h-64 mx-auto bg-no-repeat bg-bottom bg-slate-500"
                style="background-image: url('{{ asset('storage/dashboard/dashboard_bola_empresa_BdM.svg') }}');"> --}}
            <div class="w-[300px] mb-6 sm:mx-4">
                <h3 class="text-gray-600 font-extrabold text-2xl text-center mb-1 sm:mb-4">Empresas</h3>
                <p class="mb-1 text-sm text-center"><span class="fa fa-check-circle mr-2 ml-1"></span>Quiero inscribir
                    mi empresa!</p>
                <p class="mb-1 text-sm text-center"><span class="fa fa-check-circle mr-2 ml-1"></span>Quiero contratar
                    modelos</p>
                <p class="mb-3 text-sm text-center"><span class="fa fa-check-circle mr-2 ml-1"></span>Quiero realizar
                    una campaña de fotos</p>                
                <a href="{{ route('infoempresas') }}">
                    <img src="{{ asset('storage/dashboard/dashboard_bola_empresa_BdM.svg') }}" class="w-[175px] mx-auto"
                        alt="empresa" /></a>
            </div>
            {{-- <div class="bg-[length:200px] w-[200px] h-44 bg-no-repeat bg-bottom bg-slate-600"
                style="background-image: url('{{ asset('storage/dashboard/dashboard_bola_modelos_BdM.svg') }}');"> --}}
            <div class="w-[300px] mb-6 sm:mx-4">
                <h3 class="text-gray-600 font-extrabold text-2xl text-center mb-1 sm:mb-4">Lista de modelos
                </h3>
                <p class="mb-3 sm:mb-5 text-sm text-center"><span class="fa fa-check-circle mr-2 ml-1"></span>ver todas
                    las modelos</p>
                <a href="{{ route('modelos.index') }}">
                    <img src="{{ asset('storage/dashboard/dashboard_bola_modelos_BdM.svg') }}" class="w-[175px] mx-auto"
                        alt="modelos" /></a>
            </div>
        </div>
    </section>    
    <section id="seguridad" class="py-12 bg-orange-300 hidden md:flex md:flex-row">
        <div class="w-full h-[500px] mx-auto flex flex-col sm:flex-row items-start sm:items-center justify-center">
            <div class="h-[350px] w-1/2 ml-60">
                <h3 class="text-gray-600 font-extrabold fa-3x mb-1 sm:mb-4">Tu seguridad es importante</h3>
                <div class="pr-32">
                    <p class="mb-1 text-sm text-justify">Nuestro compromiso es preservar la integridad física y la
                        privacidad de las/los modelos.
                        Es por ello que disponemos de algunos requisitos indispensables para registrar a una empresa:
                    </p>
                    <div class="px-10 py-5">
                        <p class="mb-1 text-sm text-justify"><span class="fa fa-check-circle mr-2 ml-1"></span>No se
                            registran personas individuales.</p>
                        <p class="mb-1 text-sm text-justify"><span class="fa fa-check-circle mr-2 ml-1"></span>Se
                            requiere que la empresa tenga CUIT registrado en la AFIP y
                            en el caso de otros países, el registro en la oficina de hacienda correspondiente.</p>
                        <p class="mb-1 text-sm text-justify"><span class="fa fa-check-circle mr-2 ml-1"></span>El
                            representante de la empresa debe acreditar su identidad a través de su DNI.</p>
                        <p class="mb-1 text-sm text-justify"><span class="fa fa-check-circle mr-2 ml-1"></span>Dicha
                            información podrá ser consultada por el/la modelo previo a su contratación.</p>
                    </div>
                    <p class="mb-1 text-sm text-justify">Creemos que estas normas de seguridad son suficientes para
                        prevenir la trata de personas o el malintencionado ajeno.
                        No obstante, <span class="text-sm font-extrabold">Bolsa de
                            modelos</span><x-application-mark></x-application-mark> no se hará cargo bajo ningún
                        concepto,
                        de lo que suceda una vez generado el vículo entre el/la modelo y la empresa contratante.
                    </p>
                </div>
            </div>
            <div class="bg-white mr-20">
                <img class="w-full h-[350px] "
                    src="{{ asset('storage/dashboard/dashboard_escudo_seguridad_BdM.svg') }}" />

            </div>

        </div>
    </section>

    {{-- para tamaño de pantalla hasta md --}}
    <header
        class="w-screen pb-0 mt-6 bg-no-repeat bg-fixed flex flex-col md:hidden"
        style="background-image: url('{{ asset('storage/dashboard/dashboard_quienes_somos_BdM.svg') }}'); background-size: cover;">
        <div class="bg-slate-800 bg-opacity-80 p-4 m-2">
            <p class="text-justify text-white"><span class="text-xl font-extrabold">Bolsa de
                    modelos</span><x-application-mark></x-application-mark> es el primer portal de trabajos
                en Argentina dedicado exclusivamente a las/los modelos y promotoras. Nos diferenciamos de las típicas
                <span class="underline">agencias de modelos</span>
                en que no te hacemos firmar ningún contrato, lo que te permite trabajar de forma independiente.</p>
            <p class="text-justify text-white">Para resumir, <span class="text-xl font-extrabold">Bolsa de
                    modelos</span><x-application-mark></x-application-mark> es una bolsa de trabajo dedicada
                exclusivamente a las/los modelos y promotoras.</p>
        </div>
        <div class="bg-slate-800 bg-opacity-80 p-4 m-2 mt-0">
            <h1 class="underline text-xl font-bold text-slate-400 mb-2">Modelos</h1>
            <p class="text-justify text-white mb-2"><span class="text-lg font-bold">Ventajas: </span>Vos organizas tus
                plazos, vos cerrás los trabajos directamente con las empresas, tus honorarios pueden ser mayores a los
                que podés percibir por agencia.</p>
            <p class="text-justify text-white"><span class="text-lg font-bold">Desventajas: </span>Tenés que invertir
                algo de tiempo en aclarar las condiciones del trabajo y tus honorarios.</p>
        </div>
        <div class="bg-slate-800 bg-opacity-80 p-4 m-2 mt-0">
            <h1 class="underline text-xl font-bold text-slate-400 mb-2">Empresas</h1>
            <p class="text-justify text-white mb-2"><span class="text-lg font-bold">Ventajas: </span>Pagás mucho menos
                que al contratar una agencia (consultá nuestros <a href="#"
                    class="font-semibold underline text-slate-400">planes</a>). Además, diseñamos un <a
                    href="{{ route('modelos.index') }}" class="font-semibold underline text-slate-400">panel
                    especializado</a> para que puedas encontrar a la/s modelo/s según tus requerimientos.</p>
            <p class="text-justify text-white"><span class="text-lg font-bold">Desventajas: </span>Tenés que organizar
                toda la logística que implica el traslado de las modelos, etc.</p>
        </div>
    </header>
    <section id="como_funciona" class="flex flex-col md:hidden">
        <div class="w-full py-10 bg-slate-300">            
                <h3 class="text-gray-600 px-1 text-center font-extrabold fa-3x">¿Cómo funciona <span class="font-normal"><x-application-logo></x-application-logo></span>?</h3>
                <p class="w-60 fa-md mx-auto mt-2 text-center"> Hacemos de intermediario
                    entre las modelos y las empresas...
                </p>
                <div class="w-fit mx-auto mt-8 grid grid-flow-col-dense grid-cols-3 place-items-center">
                    <i class="fa-solid fa-user-tie text-blue-800 fa-5x row-span-3 justify-self-end"></i>                        
                    <p class="w-48 text-center p-2">La empresa genera una propuesta de trabajo</p>                       
                    <i class="fa-duotone fa-solid fa-arrow-right-arrow-left text-green-600 fa-3x"></i>
                    <p class="w-40 text-center p-2">Las modelos confirman o rechazan dicha propuesta</p>
                    <i class="fa-solid fa-children text-purple-600 fa-5x row-span-3 justify-self-start"></i>
                </div>
        </div>
    </section>
    <section id="servicios" class="pb-0 my-16 bg-no-repeat bg-fixed flex flex-col md:hidden">
        <div class="flex flex-col mx-auto">
            <div class="w-[300px] mb-6 sm:mx-4">
                <h3 class="text-gray-600 font-extrabold text-2xl underline text-center mb-1 sm:mb-4">Modelos</h3>
                <p class="mb-1 text-sm text-center"><span class="fa fa-check-circle mr-2 ml-1"></span>Quiero
                    incorporarme como modelo!</p>
                <p class="mb-3 text-sm text-center"><span class="fa fa-check-circle mr-2 ml-1"></span>Quiero realizar
                    mi book</p>                
                <a href="{{ route('infomodelos') }}">
                    <img src="{{ asset('storage/dashboard/dashboard_bola_modelo_BdM.svg') }}"
                        class="w-[175px] mx-auto" alt="modelo" /></a>
            </div>
            <div class="w-[300px] mb-6 sm:mx-4">
                <h3 class="text-gray-600 font-extrabold text-2xl underline text-center mb-1 sm:mb-4">Empresas</h3>
                <p class="mb-1 text-sm text-center"><span class="fa fa-check-circle mr-2 ml-1"></span>Quiero inscribir
                    mi empresa!</p>
                <p class="mb-1 text-sm text-center"><span class="fa fa-check-circle mr-2 ml-1"></span>Quiero contratar
                    modelos</p>
                <p class="mb-3 text-sm text-center"><span class="fa fa-check-circle mr-2 ml-1"></span>Quiero realizar
                    una campaña de fotos</p>                
                <a href="{{ route('infoempresas') }}">
                    <img src="{{ asset('storage/dashboard/dashboard_bola_empresa_BdM.svg') }}"
                        class="w-[175px] mx-auto" alt="empresa" /></a>
            </div>            
            <div class="w-[300px] mb-6 sm:mx-4">
                <h3 class="text-gray-600 font-extrabold text-2xl underline text-center mb-1 sm:mb-4">Lista de modelos
                </h3>
                <p class="mb-3 sm:mb-5 text-sm text-center"><span class="fa fa-check-circle mr-2 ml-1"></span>ver
                    todas las modelos</p>
                <a href="{{ route('modelos.index') }}">
                    <img src="{{ asset('storage/dashboard/dashboard_bola_modelos_BdM.svg') }}"
                        class="w-[175px] mx-auto" alt="modelos" /></a>
            </div>
        </div>
    </section>
    <section id="seguridad" class="py-4 bg-no-repeat bg-fixed md:hidden bg-orange-300">
        <div class="mx-auto">
            
                <h3 class="text-gray-600 font-extrabold fa-2x mb-1 text-center">Tu seguridad es importante</h3>
                <img class="w-1/3 m-8 float-right" src="{{ asset('storage/dashboard/dashboard_escudo_seguridad_BdM.svg') }}" />
                <div class="w-5/6 mx-auto">
                    <p class="mb-1 text-sm text-justify">Nuestro compromiso es preservar la integridad física y la
                        privacidad de las/los modelos.
                        Es por ello que disponemos de algunos requisitos indispensables para registrar a una empresa:
                    </p>
                    <div class="py-5">
                        <p class="mb-1 text-sm text-justify"><span class="fa fa-check-circle mr-2 ml-1"></span>No se
                            registran personas individuales.</p>
                        <p class="mb-1 text-sm text-justify"><span class="fa fa-check-circle mr-2 ml-1"></span>Se
                            requiere que la empresa tenga CUIT registrado en la AFIP y
                            en el caso de otros países, el registro en la oficina de hacienda correspondiente.</p>
                        <p class="mb-1 text-sm text-justify"><span class="fa fa-check-circle mr-2 ml-1"></span>El
                            representante de la empresa debe acreditar su identidad a través de su DNI.</p>
                        <p class="mb-1 text-sm text-justify"><span class="fa fa-check-circle mr-2 ml-1"></span>Dicha
                            información podrá ser consultada por el/la modelo previo a su contratación.</p>
                    </div>                    
                </div>
            
            {{-- <div class="bg-white mr-2 float-right">
                <img class="w-full"
                    src="{{ asset('storage/dashboard/dashboard_escudo_seguridad_BdM.svg') }}" />

            </div> --}}

        </div>
        <div class="px-8">
            <p class="mb-1 text-sm text-justify">Creemos que estas normas de seguridad son suficientes para
                prevenir la trata de personas o el malintencionado ajeno.
                No obstante, <span class="text-sm font-extrabold">Bolsa de
                    modelos</span><x-application-mark></x-application-mark> no se hará cargo bajo ningún
                concepto,
                de lo que suceda una vez generado el vículo entre el/la modelo y la empresa contratante.
            </p>
        </div>
    </section>


    <x-slot name="footer"></x-slot>
</x-app-layout>
