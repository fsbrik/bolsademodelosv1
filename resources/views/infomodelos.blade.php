<x-app-layout>
    {{--<x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> 
    </x-slot>--}}
    <section id="pasos" class="w-full mx-0 sm:mx-auto p-6 pb-0 sm:p-6 my-6 bg-no-repeat bg-fixed flex flex-col  justify-end"             
            style="background-image: url('{{ asset('storage/dashboard/dashboard_flor_BdM.svg') }}'); background-size: auto;">
           
            <div class="bg-slate-800 bg-opacity-80 w-2/5 p-20 ml-20 mt-16 mb-40 self-start relative">
                <div class="absolute -top-3 -left-6 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">1</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Registrate</h1>
                <p class="text-justify text-white">Hacé click <a href="{{ route('register') }}" class="font-semibold underline text-slate-400">aquí</a> o en el botón de log in/registro y luego en el link <span class="font-semibold underline text-slate-400">registrar usuario.</span></p>
                <p class="text-justify text-white">Completá el formulario de registro indicando que tu <span class="font-semibold underline text-slate-400">tipo de usuario es "modelo"</span>. Listo! Ya tenés tu usuario <x-application-mark /></p>
            </div>
            <div class="bg-slate-800 bg-opacity-80 w-2/5 p-20 mr-20 mb-20 -mt-96 self-end relative">
                <div class="absolute -top-3 left-48 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">2</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Actualizá tu perfil</h1>
                <p class="text-justify text-white">Hacé click en el link de <span class="font-semibold underline text-slate-400">perfil</span> y agregá tu foto de perfil. Además podés modificar tu nombre, email y teléfono a tu gusto.</p>
                <p class="text-justify text-white"><span class="text-lg font-bold">Tené en cuenta: </span>Los datos del perfil son los que van a visualizar solamente las empresas que <span class="font-semibold underline text-slate-400">pagaron</span> para contactarte.</p>
                <p class="text-justify text-white">De esta manera <x-application-mark /> asegura la privacidad de tu información personal.</p>
            </div>
            <div class="bg-slate-800 bg-opacity-80 w-2/5 p-20 mr-20 mb-20 self-center relative">
                <div class="absolute top-3 right-24 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">3</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Completá tu ficha técnica</h1>
                <p class="text-justify text-white">Hacé click en el link de <span class="font-semibold underline text-slate-400">ficha técnica</span> y completá la información solicitada.</p>
                <p class="text-justify text-white"><span class="text-lg font-bold">Tené en cuenta: </span>Los datos de la ficha técnica le van a permitir a las empresas encontrarte en sus búsquedas.</p>
                <p class="text-justify text-white">A través de <x-application-mark /> "matchear" modelos es mucho más sencillo para las empresas.</p>
            </div>
            <div class="bg-slate-800 bg-opacity-80 w-2/5 p-20 mr-20 mb-20 -mt-10 self-end relative">
                <div class="absolute -top-8 left-56 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">4</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Generá una reserva</h1>
                <p class="text-justify text-white">Hacé click en el link de <span class="font-semibold underline text-slate-400">reservas</span> y completá la información solicitada.</p>
                <p class="text-justify text-white"><span class="text-lg font-bold">Tené en cuenta: </span>reservá como mínimo el servicio de <span class="font-semibold underline text-slate-400">book de fotos</span>.</p>
            </div>
            <div class="bg-slate-800 bg-opacity-80 w-2/5 p-20 mr-20 mb-20 -mt-48 self-start relative">
                <div class="absolute top-3 right-24 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">5</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Último paso</h1>
                <p class="text-justify text-white">Aboná la tarifa a <x-application-mark /> y pasá a hacer las fotos en el día y horario acordados.</p>
                <p class="text-justify text-white"><span class="text-lg font-bold">Tené en cuenta: </span>en caso que <span class="text-lg font-bold">no</span> precises realizar tu <span class="font-semibold underline text-slate-400">book de fotos</span>, 
                podés enviarnos las que tengas disponibles. No obstante la tarifa de inscripción <span class="text-lg font-bold">no</span> se verá modificada en tal caso.</p>               
            </div>
            <div class="bg-slate-800 bg-opacity-80 w-2/5 p-20 mr-20 mb-20 -mt-10 self-center relative">
                <div class="absolute -top-10 right-44 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">7</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Consultá las preguntas frecuentes</h1>
                <p class="text-justify text-white">Despejá tus inquietudes en la sección de preguntas frecuentes.</p>
                <p class="text-justify text-white">Más dudas...? Podés mandarme un whatsapp al 11-2155-4283</p>              
            </div>
        </section>
        <x-slot name="footer"></x-slot>
</x-app-layout>
