<div>
    <div class="py-2">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- <section id="seleccion_de_modelos" class="px-4 py-2 bg-white border-b border-gray-200">
                    <h1 class="pl-2 fa-2x rounded-md bg-slate-200">Modelo/s a contratar</h1>
                    <div class="ml-2 flex flex-col">
                        <div class="flex flex-wrap">
                            @foreach ($modelos as $modelo)
                                    <!-- enviar el id de cada modelo -->
                                    
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Abre el modal con la galeria de fotos de la modelo seleccionada -->
                    @livewire('modelo-galeria')
                </section> --}}
                <section id="datos_del_contacto" class="px-4 pt-2 bg-white border-b border-gray-200">
                    <h1 class="pl-2 fa-2x rounded-md bg-slate-200">Datos de contacto</h1>

                    <div class="flex flex-wrap justify-start gap-x-6 gap-y-2 m-6">
                        <!-- empresa contratista -->
                        <div class="rounded-2xl border border-slate-300 mb-2">
                            <x-label for="empresa" class="rounded-t-2xl bg-slate-300 p-2"
                                value="{{ __('Empresa contratista') }}" />
                            <div class="mt-1 text-center px-2">
                                {{ $contratacion->empresa->nom_com }}
                            </div>
                        </div>

                        <!-- Nombre y apellido -->
                        <div class="rounded-2xl border border-slate-300 mb-2">
                            <x-label for="nombre" class="rounded-t-2xl bg-slate-300 p-2" value="{{ __('Nombre y apellido') }}" />
                            <div class="mt-1 text-center px-2">
                                {{ $contratacion->empresa->user->name }}
                            </div>
                        </div>

                        <!-- Teléfono -->
                        <div class="rounded-2xl border border-slate-300 mb-2">
                            <x-label for="telefono" class="rounded-t-2xl bg-slate-300 p-2" value="{{ __('Teléfono') }}" />
                            <div class="mt-1 text-center px-2">
                                {{ $contratacion->empresa->user->telefono }}
                            </div>
                        </div>

                        <!-- E-mail -->
                        <div class="rounded-2xl border border-slate-300 mb-2">
                            <x-label for="email" class="rounded-t-2xl bg-slate-300 p-2" value="{{ __('E-mail') }}" />
                            <div class="mt-1 text-center px-2">
                                {{ $contratacion->empresa->user->email }}
                            </div>
                        </div>

                    </div>
                </section>

                <section id="propuesta_de_contratacion" class="px-4 pt-2 bg-white border-b border-gray-200">
                    <h1 class="flex justify-between items-center pl-2 fa-2x rounded-md {{ $this->cambiarBgEstado($contratacion) }}">Detalles de la Propuesta de contratación
                        {{-- muestra el estado de la confirmacion --}}
                        <span class="mr-2 text-lg">{{ __('Estado: '.$this->confirmacion_display($contratacion)) }}</span>
                    </h1>

                    <div class="flex flex-wrap justify-start gap-x-6 m-6">
                        <!-- # de contratacion -->
                        <div class="rounded-2xl border border-slate-300 mb-1">
                            <x-label for="contratacion_id" class="rounded-t-2xl bg-yellow-400 p-2"
                                value="{{ __('Contratación n° ') }}" />
                            <div class="text-center mt-1">
                                {{ $contratacion->id }}
                            </div>
                        </div>

                        <!-- fecha de contratacion -->
                        {{-- <div class="rounded-2xl border border-slate-300 mb-1">
                            <x-label for="fec_con" class="rounded-t-2xl bg-slate-300 p-2" value="{{ __('Fecha de contratación') }}" />
                            <div class="mt-1 text-center px-2">
                                {{ $this->obtenerFechaFormateada($contratacion->fec_con) }}
                            </div>                                
                        </div> --}}

                        
                    </div>

                    <div class="flex flex-wrap justify-start gap-6 m-6">
                        <!-- Periodo de Contratación -->
                        <div class="border rounded-lg bg-slate-300 p-2 mb-1">
                            <h2 class="text-lg font-medium text-gray-700">Período de Contratación</h2>
                            <div class="flex space-x-4">
                                <div>
                                    <label for="fec_ini" class="block text-sm font-medium text-gray-700">Fecha de
                                        inicio</label>
                                    <div class="mt-1">
                                        {{ $this->obtenerFechaFormateada($contratacion->fec_ini) }}
                                    </div>
                                </div>
                                <div>
                                    <label for="fec_fin" class="block text-sm font-medium text-gray-700">Fecha de
                                        finalización</label>
                                    <div class="mt-1">
                                        {{ $this->obtenerFechaFormateada($contratacion->fec_fin) }}
                                    </div>
                                </div>
                                <!-- Duración (días/horas) -->
                                <div>
                                    <x-label for="duracion" value="{{ __('Duración (días/horas)') }}" />
                                    <div class="mt-1">
                                        {{ $this->obtenerDiasTrabajo($contratacion) }} días /
                                        {{ $this->obtenerHorasTotales($contratacion) }} hrs
                                    </div>
                                </div>
                            </div>

                        </div>



                        <!-- Modelos a contratar -->
                        {{-- <div class="border rounded-lg bg-slate-200 p-2 mb-1">
                            <h2 class="text-lg font-medium text-gray-700">Modelos</h2>
                            <x-label for="costo" class="block text-sm font-medium" value="{{ __('a contratar') }}" />
                            <div class="mt-1 text-center">
                                {{ $contratacion->modelos->count() }}
                            </div>                                
                        </div> --}}

                        <!-- Costo -->
                        <div class="border rounded-lg bg-slate-300 p-2 mb-1">
                            <h2 class="text-lg font-medium text-gray-700">Monto a cobrar</h2>
                            <x-label for="costo" class="block text-sm font-medium"
                                value="{{ __('total / hora de trabajo') }}" />
                            <div class="mt-1">
                                u$s {{ number_format($contratacion->mon_tot, 2) }} / u$s
                                {{ number_format($this->obtenerCostoPorHora($contratacion), 2) }}
                            </div>
                        </div>

                        <!-- Carga Horaria por Día -->
                        <div class="border rounded-lg bg-slate-200 p-2 mb-1">
                            <h2 class="text-lg font-medium text-gray-700">Carga horaria</h2>
                            <label for="hor_dia" class="block text-sm font-medium text-gray-700">por día de
                                trabajo</label>
                            <div class="mt-1">
                                {{ $contratacion->hor_dia }} hrs
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-6 m-6">
                        <!-- Descripción del Trabajo -->
                        <div class="flex-1 border rounded-lg bg-slate-400 p-2 mb-1">
                            <h2 class="text-lg font-medium text-gray-700">Descripción del Trabajo</h2>
                            <x-label for="des_tra" class="block text-sm font-medium text-gray-700">descripción
                                completa</x-label>
                            <div class="mt-1">
                                {{ $contratacion->des_tra }}
                            </div>
                        </div>
                        <!-- Estado de contratación -->
                        {{-- <div class="border rounded-lg bg-slate-300 p-2 mb-1">
                            <h2 class="text-lg font-medium text-gray-700">Estado</h2>
                            <x-label for="descripcion_trabajo" class="block text-sm font-medium text-gray-700">modelos confirmadas / modelos a contratar</x-label>
                            <div class="mt-1">
                                {{ $this->obtenerModelosConfirmados($contratacion) }} / {{ $contratacion->modelos->count() }}
                            </div>
                        </div> --}}
                    </div>

                    <!-- Dirección del Trabajo -->
                    <div class="flex flex-col gap-6 m-6">
                        <div class="w-fit border rounded-lg bg-slate-200 p-2 mb-1">
                            <h2 class="text-lg font-medium text-gray-700">Domicilio del trabajo</h2>
                            <div class="flex flex-wrap justify-start gap-3">
                                <div>
                                    <label for="dom_tra"
                                        class="block text-sm font-medium text-gray-700">Dirección</label>
                                    <div class="mt-1">
                                        {{ $contratacion->dom_tra }}
                                    </div>
                                </div>
                                <div>
                                    <label for="loc_tra"
                                        class="block text-sm font-medium text-gray-700">Localidad</label>
                                    <div class="mt-1">
                                        {{ $contratacion->loc_tra }}
                                    </div>
                                </div>
                                <div>
                                    <label for="pro_tra"
                                        class="block text-sm font-medium text-gray-700">Provincia</label>
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
                        <!-- Confirmación -->
                        <section id="confirmacion" class="flex flex-wrap items-center gap-1">
                            {{-- Muestra los botones para aceptar o rechazar la contratación --}}
                            {{-- botón de aceptación --}}
                            <button wire:click="confirmar({{ $contratacion->id }}, 1)" wire:key="contratacion-{{ $contratacion->id }}" class="fa-2x{{ $this->getButtonClass($contratacion, 'aceptar') }}" title="clic aquí para aceptar">
                                <i class="{{ $this->getIconClass($contratacion, 'aceptar') }}"></i>
                            </button>
                            {{-- botón de rechazo, si hay un visto, ya no podrá rechazar--}}
                            @if(!$this->visto($contratacion))
                                <button wire:click="confirmar({{ $contratacion->id }}, 0)" wire:key="contratacion-{{ $contratacion->id }}" class="fa-2x {{ $this->getButtonClass($contratacion, 'rechazar') }}" title="clic aquí para rechazar">
                                    <i class="{{ $this->getIconClass($contratacion, 'rechazar') }}"></i>
                                </button>
                            @endif
                        </section>


                        <x-button class="ml-4">
                            <a wire:navigate href="{{ route('modelos.contrataciones.index') }}">
                                {{ __('Volver a contrataciones') }}
                            </a>
                        </x-button>
                    </div>

                </section>
            </div>
        </div>
    </div>
</div>
