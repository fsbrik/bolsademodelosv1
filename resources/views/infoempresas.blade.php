<x-app-layout>
    {{--<x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> 
    </x-slot>--}}
    {{-- para tamaño de pantalla a partir de md --}}
    <section id="pasos_md" class="w-full mx-0 sm:mx-auto p-6 pb-0 sm:p-6 my-6 bg-no-repeat bg-fixed hidden md:flex md:flex-col justify-end"             
            style="background-image: url('{{ asset('storage/dashboard/dashboard_empresas_BdM.svg') }}'); background-size: cover;">           
            <div class="bg-slate-800 bg-opacity-80 w-2/5 p-20 ml-20 mt-16 mb-40 self-start relative">
                <div class="absolute -top-3 -left-6 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">1</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Registrate</h1>
                <p class="text-justify text-white">Hacé click <a href="{{ route('register') }}" class="font-semibold underline text-slate-400">aquí</a> o en el botón de log in/registro y luego en el link <span class="font-semibold underline text-slate-400">registrar usuario.</span></p>
                <p class="text-justify text-white">Completá el formulario de registro indicando que tu <span class="font-semibold underline text-slate-400">tipo de usuario es "empresa"</span>. Listo! Ya tenés tu usuario <x-application-mark /></p>
            </div>
            <div class="bg-slate-800 bg-opacity-80 w-2/5 p-20 mr-20 md:mr-5 mb-20 -mt-96 self-end relative">
                <div class="absolute -top-3 left-48 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">2</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Actualizá tu perfil</h1>
                <p class="text-justify text-white">Hacé click en el link de <span class="font-semibold underline text-slate-400">perfil</span> y agregá tu foto de perfil. Además podés modificar tu nombre, email y teléfono a tu gusto.</p>
                <p class="text-justify text-white"><span class="text-lg font-bold">Tené en cuenta: </span>Los datos del perfil solamente serán suministrados a la/s modelo/s que contrates.</p>
                <p class="text-justify text-white">De esta manera <x-application-mark /> asegura la privacidad de tu información personal.</p>
            </div>
            <div class="bg-slate-800 bg-opacity-80 w-2/5 p-20 mr-20 mb-20 self-center relative">
                <div class="absolute top-3 right-24 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">3</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Inscribí a tu/s empresa/s (es gratis!)</h1>
                <p class="text-justify text-white">Hacé click en el link de <span class="font-semibold underline text-slate-400">inscribir empresa</span>.</p>
                <p class="text-justify text-white"><span class="text-lg font-bold">Tené en cuenta: </span>Los datos de tu empresa serán suministrados a la/s modelo/s que contrates.</p>
                <p class="text-justify text-white">De esta manera <x-application-mark /> asegura la privacidad de la información de tu empresa.</p>
            </div>
            <div class="bg-slate-800 bg-opacity-80 w-2/5 p-20 mr-20 mb-20 -mt-10 md:mt-0 self-start relative">
                <div class="absolute -top-8 left-56 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">4</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Aboná una plan</h1>
                <p class="text-justify text-white">Hacé click en el link de <span class="font-semibold underline text-slate-400">planes</span> y seleccioná el plan que se adecúe a tus necesidades.</p>
                <p class="text-justify text-white"><span class="text-lg font-bold">Nota: </span>podés cambiarte a un plan superior abonando la diferencia.</p>
            </div>
            <div class="bg-slate-800 bg-opacity-80 w-2/5 p-20 ml-20 md:ml-6 mb-28 -mt-56 md:-mt-72 self-end relative">
                <div class="absolute -top-8 left-56 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">5</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Generá una contratación</h1>
                <p class="text-justify text-white">Hacé click en el link de <span class="font-semibold underline text-slate-400">contrataciones</span> y seleccioná a la/s modelo/s.</p>
                <p class="text-justify text-white"><span class="text-lg font-bold">Tené en cuenta: </span>solamente el <span class="font-semibold underline text-slate-400">plan full</span>
                te va a brindar la información de contacto en el momento. Para los demás planes, <x-application-mark /> es quien te va a confirmar la disponibilidad o no de la modelo.</p>
            </div>
            <div class="bg-slate-800 bg-opacity-80 w-2/5 p-20 ml-44 md:ml-14 mb-20 -mt-9 md:-mt-20 self-start relative">
                <div class="absolute top-3 right-24 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">6</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Reservas</h1>
                <p class="text-justify text-white">Adicionalmente, <x-application-mark /> te ofrece su estudio de fotografía para la realización de tus campañas.</p>
            </div>
            <div class="bg-slate-800 bg-opacity-80 w-2/5 p-20 mr-20 lg:mr-36 mb-20 -mt-52 lg:-mt-32 self-end relative">
                <div class="absolute -top-10 right-44 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">7</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Consultá las preguntas frecuentes</h1>
                <p class="text-justify text-white">Despejá tus inquietudes en la sección de preguntas frecuentes.</p>
                <p class="text-justify text-white">Más dudas...? Podés mandarme un whatsapp al 11-2155-4283</p>               
            </div>
    </section>
    {{-- para tamaño de pantalla hasta md --}}
    <section id="pasos_sm" class="w-full mx-0 sm:mx-auto p-2 pb-8 bg-no-repeat bg-fixed flex flex-wrap md:hidden justify-center"             
            style="background-image: url('{{ asset('storage/dashboard/dashboard_empresas_BdM.svg') }}'); background-size: cover;">           
            <div class="bg-slate-800 bg-opacity-80 p-6 mx-8 mt-8 w-full relative">
                <div class="absolute -top-8 right-10 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">1</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Registrate</h1>
                <p class="text-justify text-white">Hacé click <a href="{{ route('register') }}" class="font-semibold underline text-slate-400">aquí</a> o en el botón de log in/registro y luego en el link <span class="font-semibold underline text-slate-400">registrar usuario.</span></p>
                <p class="text-justify text-white">Completá el formulario de registro indicando que tu <span class="font-semibold underline text-slate-400">tipo de usuario es "empresa"</span>. Listo! Ya tenés tu usuario <x-application-mark /></p>
            </div>
            <div class="bg-slate-800 bg-opacity-80 p-6 mx-8 mt-8 w-full relative">
                <div class="absolute -top-10 left-48 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">2</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Actualizá tu perfil</h1>
                <p class="text-justify text-white">Hacé click en el link de <span class="font-semibold underline text-slate-400">perfil</span> y agregá tu foto de perfil. Además podés modificar tu nombre, email y teléfono a tu gusto.</p>
                <p class="text-justify text-white"><span class="text-lg font-bold">Tené en cuenta: </span>Los datos del perfil solamente serán suministrados a la/s modelo/s que contrates.</p>
                <p class="text-justify text-white">De esta manera <x-application-mark /> asegura la privacidad de tu información personal.</p>
            </div>
            <div class="bg-slate-800 bg-opacity-80 p-6 mx-8 mt-8 w-full relative">
                <div class="absolute -top-3 right-24 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">3</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Inscribí a tu/s empresa/s (es gratis!)</h1>
                <p class="text-justify text-white">Hacé click en el link de <span class="font-semibold underline text-slate-400">inscribir empresa</span>.</p>
                <p class="text-justify text-white"><span class="text-lg font-bold">Tené en cuenta: </span>Los datos de tu empresa serán suministrados a la/s modelo/s que contrates.</p>
                <p class="text-justify text-white">De esta manera <x-application-mark /> asegura la privacidad de la información de tu empresa.</p>
            </div>
            <div class="bg-slate-800 bg-opacity-80 p-6 mx-8 mt-8 w-full relative">
                <div class="absolute -top-8 left-56 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">4</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Aboná una plan</h1>
                <p class="text-justify text-white">Hacé click en el link de <span class="font-semibold underline text-slate-400">planes</span> y seleccioná el plan que se adecúe a tus necesidades.</p>
                <p class="text-justify text-white"><span class="text-lg font-bold">Nota: </span>podés cambiarte a un plan superior abonando la diferencia.</p>
            </div>
            <div class="bg-slate-800 bg-opacity-80 p-6 mx-8 mt-8 w-full relative">
                <div class="absolute -top-2 right-56 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">5</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Generá una contratación</h1>
                <p class="text-justify text-white">Hacé click en el link de <span class="font-semibold underline text-slate-400">contrataciones</span> y seleccioná a la/s modelo/s.</p>
                <p class="text-justify text-white"><span class="text-lg font-bold">Tené en cuenta: </span>solamente el <span class="font-semibold underline text-slate-400">plan full</span>
                te va a brindar la información de contacto en el momento. Para los demás planes, <x-application-mark /> es quien te va a confirmar la disponibilidad o no de la modelo.</p>
            </div>
            <div class="bg-slate-800 bg-opacity-80 p-6 mx-8 mt-8 w-full relative">
                <div class="absolute -top-4 right-24 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">6</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Reservas</h1>
                <p class="text-justify text-white">Adicionalmente, <x-application-mark /> te ofrece su estudio de fotografía para la realización de tus campañas.</p>
            </div>
            <div class="bg-slate-800 bg-opacity-80 p-6 mx-8 mt-8 w-full relative">
                <div class="absolute -top-10 right-44 rounded-full w-20 h-20 bg-orange-300 bg-opacity-80"><p class="fa-2x font-black text-center pt-4">7</p></div>
                <h1 class="underline text-xl font-bold text-slate-400 mb-2">Consultá las preguntas frecuentes</h1>
                <p class="text-justify text-white">Despejá tus inquietudes en la sección de preguntas frecuentes.</p>
                <p class="text-justify text-white">Más dudas...? Podés mandarme un whatsapp al 11-2155-4283</p>               
            </div>
    </section>
    <x-slot name="footer"></x-slot>
</x-app-layout>
