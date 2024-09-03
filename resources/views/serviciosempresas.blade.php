<x-app-layout>
    {{-- para tamaño de pantalla a partir de md --}}
    <section id="servicios_modelos_md" class="w-full h-[700px] p-6 bg-no-repeat bg-fixed hidden md:flex md:flex-wrap md:justify-center md:gap-16"               
            style="background-image: url('{{ asset('storage/dashboard/dashboard_empresas_BdM.svg') }}'); background-size: cover;">
                <div x-data="{open: false}" class="flex items-start w-[45%] h-fit p-4 bg-white bg-opacity-80">
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
                <div x-data="{open: false}" class="flex flex-wrap justify-center w-[45%] h-fit p-4 bg-white bg-opacity-80">
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
                    <div x-show="open" class="flex">
                        <!-- Plan Simple -->
                        <div class="w-1/3 bg-purple-300 rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 mr-2 mb-5">  
                            <div class="h-auto xl:h-80 mx-auto">
                                <h3 class="text-gray-600 text-lg">Plan Simple</h3>                                    
                                <p class="text-sm text-gray-600 mt-2">Ideal para contrataciones eventuales</p>
                                <div class="text-sm text-gray-600 mt-4">
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span> Incluye 1 contacto
                                        efectivo*</p>
                                    <p class="my-2 text-xs">*contacto que haya confirmado el trabajo</p>
                                </div>
                            </div>                                
                        </div>
                        <!-- Plan Mensual -->
                        <div class="w-1/3 bg-purple-300 rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 mr-2 mb-5">                         
                            <div class="h-auto xl:h-80 mx-auto">
                                <h3 class="text-gray-600 text-lg">Plan mensual</h3>                                    
                                <p class="text-sm text-gray-600 mt-2">Ideal para pequeñas empresas</p>
                                <p class="text-sm text-gray-600">Ideal por cambio de temporada</p>
                                <div class="text-sm text-gray-600 mt-4">
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Incluye hasta 5
                                        contactos efectivos*</p>
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Duración: 30 días</p>
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Contactás directamente
                                        sin la intervención de BdM</p>
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span> Duración: 365 días</p>
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span> Ahorro: 30%*</p>
                                    <p class="my-2 fa-xs">*comparado con 5 planes simples</p>
                                </div>
                            </div>                                
                        </div>
        
                        <!-- Plan Anual (Full) -->
                        <div class="w-1/3 bg-purple-300 rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 mr-2 mb-5">                         
                            <div class="h-auto mx-auto">
                                <h3 class="text-gray-600 text-lg">Plan anual (full)</h3>
                                <p class="text-sm text-gray-600 mt-2">Ideal para grandes empresas</p>
                                <p class="text-sm text-gray-600">Ideal para alta demanda de personal</p>
                                <div class="text-sm text-gray-600 mt-4">
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Incluye contactos
                                        ilimitados</p>
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Acceso full a la base de
                                        datos sin restricciones</p>
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Contactás directamente
                                        sin la intervención de BdM</p>
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span> Duración: 365 días</p>
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span> Ahorro: 30%*</p>
                                    <p class="my-2 fa-xs">*comparado con 12 planes mensuales</p>
                                </div>
                            </div>                                
                        </div>
                    </div>
                    {{-- cierre de todos los planes --}}
                </div>
                {{-- <div x-data="{open: false}" class="flex items-start w-[45%] h-fit p-4 bg-white bg-opacity-80">
                    <div class="min-w-48 m-4 p-4 flex flex-col flex-shrink-0 items-center rounded-md shadow-md bg-slate-300 hover:bg-slate-400 hover:shadow-2xl">
                        <h1 class="text-xl text-center font-bold mb-2">Video</h1>
                        <i class="fa-solid fa-video text-pink-900 fa-7x"></i>
                    </div>
                    <div class="py-4 px-8 text-justify">
                        <p>Llevate el video producido de la sesión de fotos para usarlo en tus redes sociales.</p>
                        <em x-show="!open" @click="open = !open" class="text-sm">leer más...</em>
                        <p x-show="open" class="text-sm pt-2">Hacemos un compilado de lo que fue tu sesión de fotos con una duración de hasta 10 min.
                        En los formatos para instagram, tiktok y youtube.
                        </p>
                    </div>
                </div>
                <div x-data="{open: false}" class="flex items-start w-[45%] h-fit p-4 bg-white bg-opacity-80">
                    <div class="min-w-48 m-4 p-4 flex flex-col flex-shrink-0 items-center rounded-md shadow-md bg-slate-300 hover:bg-slate-400 hover:shadow-2xl">
                        <h1 class="text-xl text-center font-bold mb-2">Redes sociales</h1>
                        <i class="fa-solid fa-hashtag text-emerald-600 fa-7x"></i>
                    </div>
                    <div class="py-4 px-8 text-justify">
                        <p>Publicamos 9 fotos en las redes sociales de<x-application-mark></x-application-mark></p>
                        <p class="-mt-2">Es <span class="font-bold underline text-slate-600">gratis!</span></p>
                        <em x-show="!open" @click="open = !open" class="text-sm">leer más...</em>
                        <p x-show="open" class="text-sm pt-2">La publicación en nuestras redes sociales incluye solamente fotos y lo es en forma anónima.
                            El único texto que vas a ver es tu ID de modelo que obtenés en la inscripción. Por ejemplo "mod081". Por lo tanto, la empresa
                            que haya visto tu perfil en nuestras redes, puede buscarte en nuestro sitio web por tu ID y contratarte.
                        </p>
                    </div>
                </div> --}}
                
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
                        <!-- Plan Simple -->
                        <div class="bg-purple-300 rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 mr-2 mb-5">  
                            <div class="h-auto xl:h-80 mx-auto">
                                <h3 class="text-gray-600 text-lg">Plan Simple</h3>                                    
                                <p class="text-sm text-gray-600 mt-2">Ideal para contrataciones eventuales</p>
                                <div class="text-sm text-gray-600 mt-4">
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span> Incluye 1 contacto
                                        efectivo*</p>
                                    <p class="my-2 text-xs">*contacto que haya confirmado el trabajo</p>
                                </div>
                            </div>                                
                        </div>
                        <!-- Plan Mensual -->
                        <div class="bg-purple-300 rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 mr-2 mb-5">                         
                            <div class="h-auto xl:h-80 mx-auto">
                                <h3 class="text-gray-600 text-lg">Plan mensual</h3>                                    
                                <p class="text-sm text-gray-600 mt-2">Ideal para pequeñas empresas</p>
                                <p class="text-sm text-gray-600">Ideal por cambio de temporada</p>
                                <div class="text-sm text-gray-600 mt-4">
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Incluye hasta 5
                                        contactos efectivos*</p>
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Duración: 30 días</p>
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Contactás directamente
                                        sin la intervención de BdM</p>
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span> Duración: 365 días</p>
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span> Ahorro: 30%*</p>
                                    <p class="my-2 fa-xs">*comparado con 5 planes simples</p>
                                </div>
                            </div>                                
                        </div>
        
                        <!-- Plan Anual (Full) -->
                        <div class="bg-purple-300 rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 mr-2 mb-5">                         
                            <div class="h-auto mx-auto">
                                <h3 class="text-gray-600 text-lg">Plan anual (full)</h3>
                                <p class="text-sm text-gray-600 mt-2">Ideal para grandes empresas</p>
                                <p class="text-sm text-gray-600">Ideal para alta demanda de personal</p>
                                <div class="text-sm text-gray-600 mt-4">
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Incluye contactos
                                        ilimitados</p>
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Acceso full a la base de
                                        datos sin restricciones</p>
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Contactás directamente
                                        sin la intervención de BdM</p>
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span> Duración: 365 días</p>
                                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span> Ahorro: 30%*</p>
                                    <p class="my-2 fa-xs">*comparado con 12 planes mensuales</p>
                                </div>
                            </div>                                
                        </div>
                    </div>
                    {{-- cierre de todos los planes --}}
                </div>
    </section>
        <x-slot name="footer"></x-slot>
</x-app-layout>
