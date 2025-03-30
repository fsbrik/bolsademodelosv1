<x-app-layout>
    {{-- para tamaño de pantalla a partir de md --}}
    <section id="servicios_modelos_md" class="w-full h-screen p-6 bg-no-repeat bg-fixed hidden md:flex md:flex-wrap md:justify-center md:gap-8"               
            style="background-image: url('{{ asset('storage/dashboard/dashboard_empresas_BdM.svg') }}'); background-size: cover;">
                <div x-data="{open: false}" class="flex items-start  h-fit p-4 bg-white bg-opacity-80">
                    <div class="w-48 m-4 p-4 flex flex-col flex-shrink-0 items-center rounded-md shadow-md bg-slate-300 hover:bg-slate-400 hover:shadow-2xl">
                        <h1 class="text-xl text-center font-bold mb-2">Campañas</h1>
                        <i class="fa-solid fa-building text-purple-600 fa-7x"></i>
                    </div>
                    <div class="py-4 px-8 text-justify">
                        <p>Realizamos tu campaña de indumentaria/productos</p>                        
                        <em x-show="!open" @click="open = !open" class="text-sm">leer más...</em>
                        <p x-show="open" class="text-sm">Podés contratar nuestro estudio por horas, media jornada y jornada completa.
                            Podrás hacerlo una vez que registres tu empresa, desde la sección de <span class="font-bold underline text-slate-600">reservas</span>.
                        </p>
                    </div>
                </div>
                <div x-data="{open: false}" class="flex flex-wrap justify-center flex-1 h-fit p-4 bg-white bg-opacity-80">
                    <div class="flex flex-nowrap">                    
                        <div class="w-48 m-4 p-2 flex flex-col flex-shrink-0 items-center rounded-md shadow-md bg-slate-300 hover:bg-slate-400 hover:shadow-2xl">
                            <h1 class="text-xl text-center font-bold mb-2">Contratación</h1>
                            <h1 class="text-xl text-center font-bold mb-2 -mt-4">de modelos</h1>
                            <i class="fa-solid fa-briefcase text-amber-900 fa-7x"></i>
                        </div>
                        <div class="py-4 px-8 text-justify">
                            <p>Seleccioná alguno de nuestros planes y empezá a contratar</p>
                            <em x-show="!open" @click="open = !open" class="text-sm">leer más...</em>
                            <p x-show="open" class="text-sm pt-2">Te ofrecemos 3 clases de planes: plan simple, plan mensual y plan anual.</p>
                        </div>
                    </div>
                    {{-- todos los planes --}}
                    <div x-show="open" class="flex -mb-4">
                        @livewire('plan-index')
                    </div>                    
                    {{-- cierre de todos los planes --}}
                </div>
                
    </section>
    {{-- para tamaño de pantalla hasta md --}}
    <section id="servicios_modelos_md" class="w-screen p-2 py-4 bg-no-repeat bg-fixed flex flex-col md:hidden gap-4"               
            style="background-image: url('{{ asset('storage/dashboard/dashboard_empresas_BdM.svg') }}'); background-size: cover;">
                <div x-data="{open: false}" class="flex flex-col justify-center place-items-center h-fit p-2 bg-white bg-opacity-80">
                    <div class="w-48 m-4 p-4 flex flex-col flex-shrink-0 items-center rounded-md shadow-md bg-slate-300 hover:bg-slate-400 hover:shadow-2xl">
                        <h1 class="text-xl text-center font-bold mb-2">Campañas</h1>
                        <i class="fa-solid fa-building text-purple-600 fa-7x"></i>
                    </div>
                    <div class="py-4 px-3 text-justify">
                        <p>Realizamos tu campaña de indumentaria / productos</p>                        
                        <em x-show="!open" @click="open = !open" class="text-sm">leer más...</em>
                        <p x-show="open" class="text-sm">Podés contratar nuestro estudio por horas, media jornada y jornada completa.
                            Podrás hacerlo una vez que registres tu empresa, desde la sección de <span class="font-bold underline text-slate-600">reservas</span>.
                        </p>
                    </div>
                </div>
                <div x-data="{open: false}" class="flex flex-col justify-center place-items-center h-fit p-2 bg-white bg-opacity-80">
                    <div class="w-48 m-4 p-2 flex flex-col flex-shrink-0 items-center rounded-md shadow-md bg-slate-300 hover:bg-slate-400 hover:shadow-2xl">
                        <h1 class="text-xl text-center font-bold mb-2">Contratación</h1>
                        <h1 class="text-xl text-center font-bold mb-2 -mt-4">de modelos</h1>
                        <i class="fa-solid fa-briefcase text-amber-900 fa-7x"></i>
                    </div>
                    <div class="py-4 px-3 text-justify">
                        <p>Seleccioná alguno de nuestros planes y empezá a contratar</p>
                        <em x-show="!open" @click="open = !open" class="text-sm">leer más...</em>
                        <p x-show="open" class="text-sm pt-2">Te ofrecemos 3 clases de planes: plan simple, plan mensual y plan anual.</p>
                    </div>
                    {{-- todos los planes --}}
                    <div x-show="open" class="flex flex-col">
                        @livewire('plan-index')
                    </div>
                    {{-- cierre de todos los planes --}}
                </div>
    </section>
        <x-slot name="footer"></x-slot>
</x-app-layout>
