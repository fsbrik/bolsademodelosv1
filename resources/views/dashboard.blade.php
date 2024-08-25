<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
    </x-slot>

    @guest
    <div class="pt-6 px-6 max-w-full">
        <div class="w-full sm:w-3/5 mx-auto flex flex-col sm:flex-row justify-between items-end">
            {{-- <div class="bg-[length:200px] w-auto h-56bg-no-repeat bg-bottom bg-slate-500"
                style="background-image: url('{{ asset('storage/dashboard/dashboard_bola_modelo_BdM.svg') }}');"> --}}
            <div class="w-[300px]">
                <h3 class="text-gray-600 font-extrabold text-2xl underline text-center mb-4">Modelos</h3>
                <p class="mb-1 text-sm text-center"><span class="fa fa-check-circle mr-2 ml-1"></span>Quiero incorporarme como modelo!</p>
                <p class="mb-1 text-sm text-center"><span class="fa fa-check-circle mr-2 ml-1"></span>Quiero realizar mi book</p>
                <p class="mb-5 text-sm text-center"><span class="fa fa-check-circle mr-2 ml-1"></span>Ver todos los servicios...</p>
                <img src="{{ asset('storage/dashboard/dashboard_bola_modelo_BdM.svg') }}" class="w-[300px]" alt="modelo" />
            </div>
            {{-- <div class="bg-[length:200px] w-auto h-64 mx-auto bg-no-repeat bg-bottom bg-slate-500"
                style="background-image: url('{{ asset('storage/dashboard/dashboard_bola_empresa_BdM.svg') }}');"> --}}
            <div class="w-[300px]">
                <h3 class="text-gray-600 font-extrabold text-2xl underline text-center mb-4">Empresas</h3>
                <p class="mb-1 text-sm text-center"><span class="fa fa-check-circle mr-2 ml-1"></span>Quiero inscribir mi empresa!</p>
                <p class="mb-1 text-sm text-center"><span class="fa fa-check-circle mr-2 ml-1"></span>Quiero contratar modelos</p>
                <p class="mb-1 text-sm text-center"><span class="fa fa-check-circle mr-2 ml-1"></span>Quiero realizar una campaña de fotos</p>
                <p class="mb-5 text-sm text-center"><span class="fa fa-check-circle mr-2 ml-1"></span>Ver todos los servicios...</p>
                <img src="{{ asset('storage/dashboard/dashboard_bola_empresa_BdM.svg') }}" class="w-[300px]" alt="empresa" />
            </div>
            {{-- <div class="bg-[length:200px] w-[200px] h-44 bg-no-repeat bg-bottom bg-slate-600"
                style="background-image: url('{{ asset('storage/dashboard/dashboard_bola_modelos_BdM.svg') }}');"> --}}
            <div class="w-[300px]">
                <h3 class="text-gray-600 font-extrabold text-2xl underline text-center mb-4">Lista de modelos</h3>
                <p class="mb-5 text-sm text-center"><span class="fa fa-check-circle mr-2 ml-1"></span>ver todas las modelos</p>
                <a href="{{route('modelos.index')}}">
                <img src="{{ asset('storage/dashboard/dashboard_bola_modelos_BdM.svg') }}" class="w-[300px]" alt="modelos" /></a>
            </div>
        </div>
    </div>
    @endguest

    @auth
        @if(Auth::user()->hasRole('empresa'))
            @if(!isset(Auth::user()->empresas))
            <section id="pasos" class="w-full h-screen mx-0 sm:mx-auto p-6 pb-0 sm:p-6 bg-no-repeat bg-fixed flex flex-col sm:flex-row justify-center"             
            style="background-image: url('{{ asset('storage/dashboard/dashboard_empresas_BdM.svg') }}'); background-size: cover;">
            <div class="bg-slate-800 bg-opacity-80 w-2/5 h-fit p-20 relative">
                <div class="absolute -top-3 left-48 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">1</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Actualizá tu perfil</h1>
                <p class="text-justify text-white">Hacé click en el link de <span class="font-semibold underline text-slate-400">perfil</span> y agregá tu foto de perfil. Además podés modificar tu nombre, email y teléfono a tu gusto.</p>
                <p class="text-justify text-white"><span class="text-lg font-bold">Tené en cuenta: </span>Los datos del perfil solamente serán suministrados a la/s modelo/s que contrates.</p>
                <p class="text-justify text-white">De esta manera <x-application-mark /> asegura la privacidad de tu información personal.</p>
            </div>
            <div class="bg-slate-800 bg-opacity-80 w-2/5 h-fit p-20 ml-20 mb-20 mt-48 relative">
                <div class="absolute -top-3 left-48 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">2</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Inscribí a tu/s empresa/s</h1>
                <p class="text-justify text-white">Hacé click en el link de <span class="font-semibold underline text-slate-400">inscribir empresa</span>.</p>
                <p class="text-justify text-white"><span class="text-lg font-bold">Tené en cuenta: </span>Los datos de tu empresa solamente serán suministrados a la/s modelo/s que contrates.</p>
                <p class="text-justify text-white">De esta manera <x-application-mark /> asegura la privacidad de la información de tu empresa.</p>
            </div>
            </section>
            @else
            
            @endif
        @elseif(Auth::user()->hasRole('modelo'))
        @endif
    @endauth
</x-app-layout>
