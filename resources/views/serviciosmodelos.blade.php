<x-app-layout>

    {{-- para tamaño de pantalla a partir de md --}}
    <section id="servicios_modelos_md" class="w-full h-[685px] p-16 bg-no-repeat bg-fixed hidden md:flex md:flex-wrap md:justify-center md:gap-16"               
            style="background-image: url('{{ asset('storage/dashboard/dashboard_flor_BdM.svg') }}'); background-size: auto;">
                <div x-data="{open: false}" class="flex items-start w-[45%] h-fit p-4 bg-white bg-opacity-80">
                    <div class="w-48 m-4 p-4 flex flex-col flex-shrink-0 items-center rounded-md shadow-md bg-slate-300 hover:bg-slate-400 hover:shadow-2xl">
                        <h1 class="text-xl text-center font-bold mb-2">Book de fotos</h1>
                        <i class="fa-solid fa-camera-retro text-purple-600 fa-7x"></i>
                    </div>
                    <div class="py-4 px-8 text-justify">
                        <p>Incluye 1 hora de fotografía y la publicación de 9 fotos</p>
                        <p class="-mt-2">en el sitio web de<x-application-mark></x-application-mark></p>
                        <em x-show="!open" @click="open = !open" class="text-sm">leer más...</em>
                        <p x-show="open" class="text-sm">La hora de fotografía no incluye la edición. En el caso que la modelo quiera mejorar las fotos obtenidas, por ejemplo,
                        mejorando la escena con un fondo generado por IA, etc., puede optar por reducir la sesión y utilizar el tiempo restante para la edición
                        (por ejemplo 45min. de fotografía y 15 de edición) o bien puede pagar por una hora extra o una fracción de 30 min. para tal fin.</p>
                    </div>
                </div>
                <div x-data="{open: false}" class="flex items-start w-[45%] h-fit p-4 bg-white bg-opacity-80">
                    <div class="m-4 p-4 flex flex-col flex-shrink-0 items-center rounded-md shadow-md bg-slate-300 hover:bg-slate-400 hover:shadow-2xl">
                        <h1 class="text-xl text-center font-bold mb-2">Agrandá tu combo</h1>
                        <i class="fa-solid fa-images text-pink-400 fa-7x"></i>
                    </div>
                    <div class="py-4 px-8 text-justify">
                        <p>Te publicamos <span class="font-bold underline text-slate-600">todas</span> las fotos obtenidas.</p>
                        <em x-show="!open" @click="open = !open" class="text-sm">leer más...</em>
                        <p x-show="open" class="text-sm pt-2">El servicio básico incluye solamente la publicación de 9 fotos. Al publicar la totalidad de las fotos
                            obtenidas durante la sesión, tu perfil toma mayor relevancia y aumentás tus posibilidades de ser contratada por una empresa.
                        </p>
                    </div>
                </div>
                <div x-data="{open: false}" class="flex items-start w-[45%] h-fit p-4 bg-white bg-opacity-80">
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
                </div>
                
    </section>
    {{-- para tamaño de pantalla hasta md --}}
    <section id="servicios_modelos_md" class="w-full bg-no-repeat bg-fixed md:hidden flex flex-col mt-4 md:justify-center gap-4"               
            style="background-image: url('{{ asset('storage/dashboard/dashboard_flor_BdM.svg') }}'); background-size: auto;">
                <div x-data="{open: false}" class="flex flex-col place-items-center h-fit p-4 bg-white bg-opacity-80">
                    <div class="m-4 p-4 flex flex-col flex-shrink-0 items-center rounded-md shadow-md bg-slate-300 hover:bg-slate-400 hover:shadow-2xl">
                        <h1 class="text-xl text-center font-bold mb-2">Book de fotos</h1>
                        <i class="fa-solid fa-camera-retro text-purple-600 fa-4x"></i>
                    </div>
                    <div class="py-4 px-8 text-justify">
                        <div class="mx-auto w-fit">
                            <p>Incluye 1 hora de fotografía y la publicación de
                            9 fotos en el sitio web de<x-application-mark></x-application-mark></p>
                        </div>
                        <em x-show="!open" @click="open = !open" class="text-sm">leer más...</em>
                        <p x-show="open" class="text-sm">La hora de fotografía no incluye la edición. En el caso que la modelo quiera mejorar las fotos obtenidas, por ejemplo,
                        mejorando la escena con un fondo generado por IA, etc., puede optar por reducir la sesión y utilizar el tiempo restante para la edición
                        (por ejemplo 45min. de fotografía y 15 de edición) o bien puede pagar por una hora extra o una fracción de 30 min. para tal fin.</p>
                    </div>
                </div>
                <div x-data="{open: false}" class="flex flex-col place-items-center h-fit p-4 bg-white bg-opacity-80">
                    <div class="w-40 m-4 p-4 flex flex-col flex-shrink-0 items-center rounded-md shadow-md bg-slate-300 hover:bg-slate-400 hover:shadow-2xl">
                        <h1 class="text-xl text-center font-black">Agrandá</h1>
                        <h1 class="text-xl text-center font-black -mt-2 mb-2">tu combo</h1>
                        <i class="fa-solid fa-images text-pink-400 fa-4x"></i>
                    </div>
                    <div class="py-4 px-8 text-justify">
                        <div class="mx-auto w-fit">
                            <p>Te publicamos <span class="font-bold underline text-slate-600">todas</span> las fotos obtenidas.</p>
                        </div>
                        <em x-show="!open" @click="open = !open" class="text-sm">leer más...</em>
                        <p x-show="open" class="text-sm pt-2">El servicio básico incluye solamente la publicación de 9 fotos. Al publicar la totalidad de las fotos
                            obtenidas durante la sesión, tu perfil toma mayor relevancia y aumentás tus posibilidades de ser contratada por una empresa.
                        </p>
                    </div>
                </div>
                <div x-data="{open: false}" class="flex flex-col place-items-center h-fit p-4 bg-white bg-opacity-80">
                    <div class="w-40 m-4 px-8 py-4 flex flex-col flex-shrink-0 items-center rounded-md shadow-md bg-slate-300 hover:bg-slate-400 hover:shadow-2xl">
                        <h1 class="text-xl text-center font-bold mb-2">Video</h1>
                        <i class="fa-solid fa-video text-pink-900 fa-4x"></i>
                    </div>
                    <div class="py-4 px-8 text-justify">
                        <div class="mx-auto w-fit">
                            <p>Llevate el video producido de la sesión de fotos para usarlo en tus redes sociales.</p>
                        </div>
                        <em x-show="!open" @click="open = !open" class="text-sm">leer más...</em>
                        <p x-show="open" class="text-sm pt-2">Hacemos un compilado de lo que fue tu sesión de fotos con una duración de hasta 10 min.
                        En los formatos para instagram, tiktok y youtube.
                        </p>
                    </div>
                </div>
                <div x-data="{open: false}" class="flex flex-col place-items-center h-fit p-4 bg-white bg-opacity-80">
                    <div class="w-fit m-4 p-4 flex flex-col flex-shrink-0 items-center rounded-md shadow-md bg-slate-300 hover:bg-slate-400 hover:shadow-2xl">
                        <h1 class="text-xl text-center font-bold mb-2">Redes sociales</h1>
                        <i class="fa-solid fa-hashtag text-emerald-600 fa-4x"></i>
                    </div>
                    <div class="py-4 px-8 text-justify">
                        <div class="mx-auto w-fit">
                            <p>Publicamos 9 fotos en las redes sociales de<x-application-mark></x-application-mark></p>
                            <p class="-mt-2">Es <span class="font-bold underline text-slate-600">gratis!</span></p>
                        </div>
                        <em x-show="!open" @click="open = !open" class="text-sm">leer más...</em>
                        <p x-show="open" class="text-sm pt-2">La publicación en nuestras redes sociales incluye solamente fotos y lo es en forma anónima.
                            El único texto que vas a ver es tu ID de modelo que obtenés en la inscripción. Por ejemplo "mod081". Por lo tanto, la empresa
                            que haya visto tu perfil en nuestras redes, puede buscarte en nuestro sitio web por tu ID y contratarte.
                        </p>
                    </div>
                </div>
                
    </section>
        <x-slot name="footer"></x-slot>
</x-app-layout>
