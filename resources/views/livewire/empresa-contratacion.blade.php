<div>
    <div class="py-2">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <section id="seleccion_de_modelos" class="px-4 py-2 bg-white border-b border-gray-200">
                    <h1 class="pl-2 fa-2x rounded-md bg-slate-200">Modelo/s a contratar</h1>
                    <div class="ml-2 flex flex-col">
                        <div class="flex flex-wrap">
                            @foreach ($modelos as $modelo)
                                <div class="flex flex-col m-2">
                                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                        <div class="p-2 relative">
                                            <p class="font-semibold">## {{ $modelo->mod_id }}</p>
                                            <img src="{{ $modelo->user->profile_photo_url }}" alt="{{ $modelo->mod_Id }}"
                                                class="h-24 w-14 mx-auto rounded-md object-cover">
                                            <div x-data="{ toggle: false }" class="flex flex-col my-1">
                                                <x-label-sm x-show="!toggle"  @click="toggle = !toggle"><i class="fas fa-magnifying-glass cursor-pointer"></i>+ info</x-label-sm>
                                                <div x-show="toggle" @click="toggle = !toggle" class="cursor-pointer">
                                                    @can('modelos.datos_de_contacto')
                                                    <x-label-sm
                                                        class="border-t break-all">{{ $modelo->user->name }}</x-label-sm>
                                                    <x-label-sm>{{ $modelo->user->telefono }}</x-label-sm>
                                                    <x-label-sm
                                                        class="border-b break-all">{{ $modelo->user->email }}</x-label-sm>
                                                    @endcan
                                                    <x-label-sm>{{ __('Edad: ') . \Carbon\Carbon::parse($modelo->fec_nac)->age . __(' años') }}</x-label-sm>
                                                    <x-label-sm>{{ __('Estatura: ') . $modelo->estatura . __(' mts.') }}</x-label-sm>
                                                    <x-label-sm>{{ __('Calzado: ') . $modelo->calzado }}</x-label-sm>
                                                    <x-label-sm>{{ __('Medidas: ') . $modelo->medidas }}</x-label-sm>
                                                    <x-label-sm>{{ __('Viajar al exterior: ') . ($modelo->dis_via ? 'si' : 'no') }}</x-label-sm>
                                                    <x-label-sm
                                                        class="border-b">{{ __('Título de modelo: ') . ($modelo->tit_mod ? 'si' : 'no') }}</x-label-sm>
                                                    @can('modelos.ficha_tecnica')
                                                        <x-label-sm><i class="fas fa-money-bill-wave"></i><i
                                                                class="fas fa-money-bill-wave px-1"></i><i
                                                                class="fas fa-money-bill-wave"></i></x-label-sm>
                                                        <x-label-sm>{{ __('1/2 jornada: u$s') . $modelo->tar_med }}</x-label-sm>
                                                        <x-label-sm>{{ __('Jorn. comp.: u$s') . $modelo->tar_com }}</x-label-sm>
                                                    @endcan
                                                    <div class="border-t">
                                                        <x-label-sm><i class="fas fa-map-marker-alt pr-1"></i>{{ __('Residencia: ') . $modelo->zon_res }}</x-label-sm>
                                                        <x-label-sm><i class="fas fa-book"></i>{{ __('Nivel de inglés: ') . $modelo->ingles }}</x-label-sm>
                                                        <x-label-sm><i class="fas fa-briefcase"></i>{{ __('Disponibilidad: ') . $modelo->dis_tra }}</x-label-sm>
                                                    </div>
                                                </div>
                                                <div wire:click="$dispatch('openGallery', { modeloId: {{ $modelo->id }} })" class="cursor-pointer">
                                                <i class="fas fa-image text-success mr-1"></i><x-label-sm class="inline-block lowercase">galería</x-label-sm>
                                                </div>
                                                <i class="fas fa-circle-minus text-red-600 absolute bottom-4 right-2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="flex items-stretch m-2">
                                <div class="bg-white shadow-md rounded-lg overflow-hidden flex items-center px-2">
                                <i class="fas fa-circle-plus fa-6x text-green-600"></i>
                                </div>
                            </div>
                        </div>
                        @if(isset($pagination) && $pagination)                        
                            <div class="my-4 w-fit">
                                {{ $modelos->links() }}
                            </div>
                        @endif

                    </div>
                    {{-- Abre el modal con la galeria de fotos de la modelo seleccionada --}}
                    @livewire('modelo-galeria')
                </section>
                <section id="propuesta" class="px-4 py-2 bg-white border-b border-gray-200">
                    <h1 class="pl-2 fa-2x rounded-md bg-slate-200">Propuesta</h1>
                    <div class="ml-2">
                
                        <!-- Periodo de Contratación -->
                        <div class="mb-4">
                            <h2 class="text-lg font-medium text-gray-700">Periodo de Contratación</h2>
                            <div class="flex space-x-4">
                                <div class="w-1/3">
                                    <label for="fec_ini" class="block text-sm font-medium text-gray-700">Fecha Inicio</label>
                                    <input type="date" wire:model.live.debounce.250ms="fec_ini" id="fec_ini" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                                <div class="w-1/3">
                                    <label for="fec_fin" class="block text-sm font-medium text-gray-700">Fecha Fin</label>
                                    <input type="date" wire:model.live.debounce.250ms="fec_fin" id="fec_fin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                                <div class="w-1/3 flex items-end">
                                    <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded" @click="$wire.fec_fin = $wire.fec_ini">
                                        Mismo Día
                                    </button>
                                </div>
                            </div>
                            <div class="mt-2 text-sm text-gray-600">
                                Días de trabajo: <span class="font-semibold">{{ $dias_trabajo }}</span>
                            </div>
                        </div>
                
                        <!-- Carga Horaria por Día -->
                        <div class="mb-4">
                            <label for="hor_dia" class="block text-sm font-medium text-gray-700">Carga Horaria por Día</label>
                            <input type="number" wire:model.live.debounce.250ms="hor_dia" id="hor_dia" class="mt-1 block w-full sm:w-1/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <div class="mt-2 text-sm text-gray-600">
                                Valor por hora de trabajo: <span class="font-semibold">u$s {{ number_format($valor_hora, 2) }}</span>
                            </div>
                        </div>
                
                        <!-- Dirección del Trabajo -->
                        <div class="mb-4">
                            <h2 class="text-lg font-medium text-gray-700">Dirección del Trabajo</h2>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div>
                                    <label for="dom_tra" class="block text-sm font-medium text-gray-700">Dirección</label>
                                    <input type="text" wire:model="dom_tra" id="dom_tra" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                                <div>
                                    <label for="loc_tra" class="block text-sm font-medium text-gray-700">Localidad</label>
                                    <input type="text" wire:model="loc_tra" id="loc_tra" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                                <div>
                                    <label for="pro_tra" class="block text-sm font-medium text-gray-700">Provincia</label>
                                    <input type="text" wire:model="pro_tra" id="pro_tra" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                                <div>
                                    <label for="pai_tra" class="block text-sm font-medium text-gray-700">País</label>
                                    <input type="text" wire:model="pai_tra" id="pai_tra" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                            </div>
                        </div>
                
                        <!-- Monto Total Ofrecido -->
                        <div class="mb-4">
                            <label for="mon_tot" class="block text-sm font-medium text-gray-700">Monto Total Ofrecido</label>
                            <div class="text-sm text-gray-600">
                                <em>*Monto por la totalidad de los días de trabajo</em>
                            </div>
                            <input type="number" wire:model.live.debounce.250ms="mon_tot" id="mon_tot" class="mt-1 block w-full sm:w-1/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            
                        </div>
                
                        <!-- Descripción del Trabajo -->
                        <div class="mb-4">
                            <label for="des_tra" class="block text-sm font-medium text-gray-700">Descripción del Trabajo</label>
                            <textarea wire:model="des_tra" id="des_tra" class="mt-1 block w-full sm:w-1/2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        </div>
                
                        <!-- Botón para enviar la propuesta -->
                        <button wire:click="submit" class="bg-green-500 text-white px-4 py-2 rounded">Enviar Propuesta</button>
                    </div>
                </section>
                
                
            </div>
        </div>
    </div>
</div>
