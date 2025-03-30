<div>
    <div class="py-2">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <section id="seleccion_de_modelos" class="px-4 py-2 bg-white border-b border-gray-200">
                    <h1 class="pl-2 fa-2x rounded-md bg-slate-200">Modelo/s a contratar</h1>
                    <div class="flex justify-between">    
                        <div class="ml-2 flex flex-col">
                            <div class="flex flex-wrap">
                                @foreach ($modelos as $modelo)
                                        {{-- enviar el id de cada modelo --}}
                                        
                                        <div class="flex flex-col m-2">
                                            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                                <div class="p-2 relative">
                                                    <p class="font-semibold">## {{ $modelo->mod_id }}</p>
                                                    <img src="{{ $modelo->user->profile_photo_url }}" alt="{{ $modelo->mod_Id }}"
                                                        class="h-24 w-14 mx-auto rounded-md object-cover">
                                                    <div x-data="{ toggle: false }" class="flex flex-col my-1">
                                                        <x-label-sm x-show="!toggle"  @click="toggle = !toggle"><i class="fas fa-magnifying-glass cursor-pointer"></i>+ info</x-label-sm>
                                                        <div x-show="toggle" @click="toggle = !toggle" class="cursor-pointer">
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
                                                        {{-- Estado de la confirmación por parte de la modelo (pendiente, aceptado o rechazado) --}}
                                                        <x-label-sm :class="$this->getEstadoClass($modelo)">{{ $this->confirmacionEstado($modelo) }}
                                                        </x-label-sm>                                          
                                                        @if($this->confirmacionEstado($modelo) == 'Aceptado')
                                                            <div x-data="{ contacto: false }" class="flex flex-col my-1">
                                                                <button x-show="!contacto"  @click="contacto = !contacto" wire:click.prevent="establecerVisto({{$modelo->id}})" wire:key="contacto-{{$modelo->id}}"><i class="fas fa-magnifying-glass cursor-pointer"></i>Contacto</button>
                                                                <div x-show="contacto" @click="contacto = !contacto" class="cursor-pointer">
                                                                    <x-label-sm class="border-t break-all">{{ $modelo->user->name }}</x-label-sm>
                                                                    <x-label-sm>{{ $modelo->user->telefono }}</x-label-sm>
                                                                    <x-label-sm class="border-b break-all">{{ $modelo->user->email }}</x-label-sm>
                                                                </div>
                                                            </div>
                                                        @endif          
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                            </div>
                            <div class="w-fit">
                                {{ $modelos->links() }}
                            </div>
                        </div>
                        <div class="flex items-stretch m-2">
                            <div class="w-36 h-44 bg-green-100 shadow-md rounded-lg overflow-hidden flex flex-col justify-center px-4 gap-4">
                                <label class="text-center leading-tight font-medium text-green-600 mb-2">Cantidad de modelos a contratar</label>
                                <label class="mx-auto block w-20 text-center fa-lg font-bold rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    {{ $contratacion->cant_mod }}
                                </label>
                            </div>
                        </div>
                    </div>
                    {{-- Abre el modal con la galeria de fotos de la modelo seleccionada --}}
                    @livewire('modelo-galeria')
                </section>
                
                <section id="propuesta_de_contratacion" class="px-4 py-2 bg-white border-b border-gray-200">
                    <h1 class="pl-2 fa-2x rounded-md bg-slate-200">Detalles de la Propuesta de contratación</h1>

                    <div class="flex flex-wrap justify-start gap-6 m-6">
                         <!-- # de contratacion -->
                         <div class="rounded-2xl border border-slate-300 mb-4">
                            <x-label for="contratacion_id" class="rounded-t-2xl bg-yellow-400 p-2" value="{{ __('Contratación n° ') }}" />
                            <div class="text-center mt-1">
                                {{ $contratacion->id }}
                            </div>                                
                        </div>

                        <!-- fecha de contratacion -->
                        <div class="rounded-2xl border border-slate-300 mb-4">
                            <x-label for="fec_con" class="rounded-t-2xl bg-slate-300 p-2" value="{{ __('Fecha de contratación') }}" />
                            <div class="mt-1 text-center px-2">
                                {{ $this->obtenerFechaFormateada($contratacion->fec_con) }}
                            </div>                                
                        </div>

                        <!-- empresa contratista -->
                        <div class="rounded-2xl border border-slate-300 mb-4">
                            <x-label for="empresa" class="rounded-t-2xl bg-slate-300 p-2" value="{{ __('Empresa contratista') }}" />
                            <div class="mt-1 text-center px-2">
                                {{ $contratacion->empresa->nom_com }}
                            </div>                                
                        </div>
                    </div>

                    <div class="flex flex-wrap justify-start gap-6 m-6">
                        <!-- Periodo de Contratación -->
                        <div class="border rounded-lg bg-slate-300 p-2 mb-4">
                            <h2 class="text-lg font-medium text-gray-700">Período de Contratación</h2>
                            <div class="flex space-x-4">
                                <div>
                                    <label for="fec_ini" class="block text-sm font-medium text-gray-700">Fecha de inicio</label>
                                    <div class="mt-1">
                                        {{ $this->obtenerFechaFormateada($contratacion->fec_ini) }}
                                    </div>
                                </div>
                                <div>
                                    <label for="fec_fin" class="block text-sm font-medium text-gray-700">Fecha de finalización</label>
                                    <div class="mt-1">
                                        {{ $this->obtenerFechaFormateada($contratacion->fec_fin) }}
                                    </div>
                                </div>
                                <!-- Duración (días/horas) -->
                                <div>
                                    <x-label for="duracion" value="{{ __('Duración (días/horas)') }}" />
                                    <div class="mt-1">
                                        {{ $this->obtenerDiasTrabajo($contratacion) }} días / {{ $this->obtenerHorasTotales($contratacion) }} hrs
                                    </div>                                
                                </div>
                            </div>
                            
                        </div>

                        

                        <!-- Modelos a contratar -->
                        <div class="border rounded-lg bg-slate-200 p-2 mb-4">
                            <h2 class="text-lg font-medium text-gray-700">Modelos</h2>
                            <x-label for="costo" class="block text-sm font-medium" value="{{ __('a contratar') }}" />
                            <div class="mt-1 text-center">
                                {{ $contratacion->cant_mod }}
                            </div>                                
                        </div>

                        <!-- Costo -->
                        <div class="border rounded-lg bg-slate-300 p-2 mb-4">
                            <h2 class="text-lg font-medium text-gray-700">Costo por modelo</h2>
                            <x-label for="costo" class="block text-sm font-medium" value="{{ __('total / hora de trabajo') }}" />
                            <div class="mt-1">
                                u$s {{ number_format($contratacion->mon_tot, 2) }} / u$s {{ number_format($this->obtenerCostoPorHora($contratacion), 2) }}
                            </div>                                
                        </div>

                        <!-- Carga Horaria por Día -->
                        <div class="border rounded-lg bg-slate-200 p-2 mb-4">
                            <h2 class="text-lg font-medium text-gray-700">Carga horaria</h2>
                            <label for="hor_dia" class="block text-sm font-medium text-gray-700">por día de trabajo</label>
                            <div class="mt-1">
                                {{ $contratacion->hor_dia }} hrs
                            </div>                           
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-6 m-6">
                        <!-- Descripción del Trabajo -->
                        <div class="flex-1 border rounded-lg bg-slate-400 p-2 mb-4">
                            <h2 class="text-lg font-medium text-gray-700">Descripción del Trabajo</h2>
                            <x-label for="des_tra" class="block text-sm font-medium text-gray-700">descripción completa</x-label>
                            <div class="mt-1">
                                {{ $contratacion->des_tra }}
                            </div>
                        </div>   
                        <!-- Estado de contratación -->
                        <div class="border rounded-lg bg-slate-300 p-2 mb-4">
                            <h2 class="text-lg font-medium text-gray-700">Estado</h2>
                            <x-label for="descripcion_trabajo" class="block text-sm font-medium text-gray-700">modelos confirmadas / modelos a contratar</x-label>
                            <div class="mt-1">
                                {{ $this->obtenerModelosConfirmados($contratacion) }} / {{ $contratacion->cant_mod }}
                            </div>
                        </div>                  
                    </div>  

                    <!-- Dirección del Trabajo -->
                    <div class="flex flex-col gap-6 m-6">
                        <div class="w-fit border rounded-lg bg-slate-200 p-2 mb-4">
                            <h2 class="text-lg font-medium text-gray-700">Domicilio del trabajo</h2>
                            <div class="flex flex-wrap justify-start gap-3">
                                <div>
                                    <label for="dom_tra" class="block text-sm font-medium text-gray-700">Dirección</label>
                                    <div class="mt-1">
                                        {{ $contratacion->dom_tra }}
                                    </div>
                                </div>
                                <div>
                                    <label for="loc_tra" class="block text-sm font-medium text-gray-700">Localidad</label>
                                    <div class="mt-1">
                                        {{ $contratacion->loc_tra }}
                                    </div>
                                </div>
                                <div>
                                    <label for="pro_tra" class="block text-sm font-medium text-gray-700">Provincia</label>
                                    <div class="mt-1">
                                        {{ $contratacion->pro_tra }}
                                    </div>
                                </div>
                                <div>
                                    <label for="pai_tra" class="block text-sm font-medium text-gray-700">País</label>
                                    <div class="mt-1">
                                        {{ $contratacion->pai_tra }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-end my-4">
                        @if($this->planContratado)
                            @if($this->checkConfirmacion($contratacion) || !$this->checkFecFinContratacion($contratacion))
                                <a href="{{ route('empresas.contrataciones.edit', $contratacion->id) }}" class="text-yellow-600 hover:text-yellow-900 ml-4"
                                    title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif
                            @if($this->checkConfirmacion($contratacion))
                                <form wire:submit="destroy" class="inline ml-4">
                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Borrar"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar esta propuesta de contratación?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            @endif
                        @endif
                        @can('empresas.index')
                            <x-button class="ml-4">
                                <a wire:navigate href="{{ route('empresas.contrataciones.index') }}">
                                    {{ __('Volver') }}
                                </a>
                            </x-button>
                        @endcan
                    </div>
                
                </section>
            </div>
        </div>
    </div>
</div>
