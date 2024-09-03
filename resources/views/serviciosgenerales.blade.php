<x-app-layout>
    <section id="servicios_md" class="mt-4 min-h-[600px] lg:h-[675px] text-center p-6 pb-0 bg-no-repeat bg-fixed flex justify-center"
            style="background-image: url('{{ asset('storage/dashboard/dashboard_servicios_BdM.svg') }}'); background-size: cover;">           
            <a href="{{ route('serviciosmodelos') }}">
                <div class="bg-white bg-opacity-80 p-2 sm:p-14 mx-2 sm:mx-14 mt-20 rounded-md">
                    <h1 class="text-xl font-bold mb-2">Servicios para modelos</h1>
                    <p class="text-sm">Quiero conocer los servicios que ofrecen para las <span class="font-semibold underline text-slate-700">modelos</span></p>
                </div>
            </a>
            <a href="{{ route('serviciosempresas') }}">
                <div class="bg-white bg-opacity-80 p-2 sm:p-14 mx-2 mt-20 rounded-md">
                    <h1 class="text-xl font-bold mb-2">Servicios para empresas</h1>
                    <p class="text-sm">Quiero conocer los servicios que ofrecen para las <span class="font-semibold underline text-slate-700">empresas</span></p>
                </div>
            </a>            
    </section>
    <x-slot name="footer"></x-slot>
</x-app-layout>
