<div>
    <div class="py-2">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form wire:submit="update">
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
                                                        <div class="flex flex-wrap">
                                                            <div wire:click="$dispatch('openGallery', { modeloId: {{ $modelo->id }} })" class="cursor-pointer mr-2">
                                                                <i class="fas fa-image text-success mr-1"></i><x-label-sm class="inline-block lowercase">galería</x-label-sm>
                                                            </div>
                                                            {{-- Botón para remover el modelo --}}
                                                            @if ($this->confirmacionEstado($modelo) === 'Pendiente')
                                                                <button wire:click.prevent="removeModelo({{ $modelo->id }})"
                                                                    class="text-red-600 hover:text-red-900"
                                                                    title="Remover">
                                                                    <i class="fas fa-circle-minus"></i>
                                                                </button>
                                                            @endif                                                        
                                                        </div>
                                                        {{-- Estado de la confirmación por parte de la modelo (pendiente, aceptado o rechazado) --}}
                                                        <x-label-sm :class="$this->confirmacionEstado($modelo) == 'Pendiente' ? 'bg-slate-400 p-1 mt-2 rounded-md font-semibold text-center' : 
                                                                            ($this->confirmacionEstado($modelo) == 'Aceptado' ? 'bg-green-500 p-1 mt-2 rounded-md font-semibold text-center' :
                                                                            'bg-red-500 p-1 mt-2 rounded-md font-semibold text-center') ">{{ $this->confirmacionEstado($modelo) }}</x-label-sm>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="flex items-stretch m-2">
                                        <div class="bg-white shadow-md rounded-lg overflow-hidden flex items-center p-2">
                                            <a href="{{ route('modelos.index') }}"><i class="fas fa-circle-plus fa-6x text-green-600"></i></a>
                                        </div>
                                    </div>
                                </div>                      
                                <div class="w-fit">
                                    {{ $modelos->links() }}
                                </div>
                            </div>
                            <div class="flex items-stretch m-2">
                                <div class="w-36 h-44 bg-green-100 shadow-md rounded-lg overflow-hidden flex flex-col justify-center px-4 gap-4">
                                    <label for="cant_mod" class="text-center leading-tight font-medium text-green-600">Cantidad de modelos a contratar</label>
                                    <input type="number" wire:model.live="cant_mod"
                                    class="mx-auto block w-20 text-center rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
                                    <x-input-error for="cant_modMaxima"></x-input-error>
                                    <x-input-error for="cant_mod"></x-input-error>
                                </div>
                            </div>
                        </div>
                        {{-- Abre el modal con la galeria de fotos de la modelo seleccionada --}}
                        @livewire('modelo-galeria')
                    </section>
                    
                        <section id="propuesta" class="relative px-4 py-2 bg-white border-b border-gray-200">
                            <section id="envolvente_de_deshabilitacion" class="{{ $this->checkConfirmacion($contratacion) ? 'flex flex-wrap items-center absolute z-10 opacity-30 top-0 left-0 w-full h-screen rounded bg-slate-400' : 'hidden' }}">
                                <p class="px-10 mx-auto fa-lg transform -rotate-12 w-full break-words whitespace-normal leading-6">
                                    Ya no se puede modificar ni eliminar esta propuesta debido a que hay modelos que confirmaron.<br>
                                    Si necesitás hacerlo, comunicate con el administrador.
                                </p>
                            </section>
                            <h1 class="pl-2 fa-2x rounded-md bg-slate-200">Propuesta</h1>
                            <div class="ml-2">                    
                                <div class="flex flex-wrap mt-2">
                                    <!-- empresa contratista -->
                                    <div class="flex-1 max-w-2/3">
                                        <x-label for="empresa" value="{{ __('Empresa contratista') }}" />
                                        <select id="empresa" wire:model.live.debounce.250ms="empresa"
                                            class="mt-1 w-1/3 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                            {{ $this->checkConfirmacion($contratacion) }}>
                                                <option>{{ __('Seleccionar empresa') }}
                                                @foreach ($empresas as $empresa)
                                                    <option value="{{ $empresa['id'] }}">{{ __($empresa['nom_com']) }}
                                                    </option>
                                                @endforeach
                                        </select>                                
                                    </div>

                                    <!-- # de contratacion -->
                                    <div class="rounded-2xl border border-slate-300 mr-4">
                                        <x-label for="contratacion_id" class="rounded-t-2xl bg-yellow-400 p-2" value="{{ __('Contratación n° ') }}" />
                                        <div class="text-center mt-1">
                                            {{ $contratacion->id }}
                                        </div>                                
                                    </div>
                                </div>

                                <!-- Periodo de Contratación -->
                                <div class="mb-4">
                                    <h2 class="text-lg font-medium text-gray-700">Periodo de Contratación</h2>
                                    <div class="flex space-x-4">
                                        <div class="w-1/3">
                                            <label for="fec_ini" class="block text-sm font-medium text-gray-700">Fecha Inicio</label>
                                            <input type="date" wire:model.live.debounce.250ms="fec_ini" id="fec_ini" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                            {{ $this->checkConfirmacion($contratacion) }}>
                                        </div>
                                        <div class="w-1/3">
                                            <label for="fec_fin" class="block text-sm font-medium text-gray-700">Fecha Fin</label>
                                            <input type="date" wire:model.live.debounce.250ms="fec_fin" id="fec_fin" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                            {{ $this->checkConfirmacion($contratacion) }}>
                                        </div>
                                        <div class="w-1/3 flex items-end">
                                            <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded" {{ $this->checkConfirmacion($contratacion) }} wire:click="setMismoDia">
                                                Mismo día
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
                                    <input type="number" wire:model.live.debounce.250ms="hor_dia" id="hor_dia" {{ $this->checkConfirmacion($contratacion) }}
                                    class="mt-1 block w-full sm:w-1/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
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
                                            <input type="text" wire:model.live.debounce.250ms="dom_tra" id="dom_tra" {{ $this->checkConfirmacion($contratacion) }}
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        </div>
                                        <div>
                                            <label for="loc_tra" class="block text-sm font-medium text-gray-700">Localidad</label>
                                            <input type="text" wire:model.live.debounce.250ms="loc_tra" id="loc_tra" {{ $this->checkConfirmacion($contratacion) }}
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        </div>
                                        <div>
                                            <label for="pro_tra" class="block text-sm font-medium text-gray-700">Provincia</label>
                                            <input type="text" wire:model.live.debounce.250ms="pro_tra" id="pro_tra" {{ $this->checkConfirmacion($contratacion) }}
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        </div>
                                        <div>
                                            <label for="pai_tra" class="block text-sm font-medium text-gray-700">País</label>
                                            <input type="text" wire:model.live.debounce.250ms="pai_tra" id="pai_tra" {{ $this->checkConfirmacion($contratacion) }}
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- Monto Total Ofrecido -->
                                <div class="mb-4">
                                    <label for="mon_tot" class="block text-sm font-medium text-gray-700">Monto Total Ofrecido</label>
                                    <div class="text-sm text-gray-600">
                                        <em>*Monto por la totalidad de los días de trabajo</em>
                                    </div>
                                    <input type="number" wire:model.live.debounce.250ms="mon_tot" id="mon_tot" {{ $this->checkConfirmacion($contratacion) }}
                                    class="mt-1 block w-full sm:w-1/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    
                                </div>
                        
                                <!-- Descripción del Trabajo -->
                                <div class="mb-4">
                                    <label for="des_tra" class="block text-sm font-medium text-gray-700">Descripción del Trabajo</label>
                                    <textarea wire:model.live.debounce.250ms="des_tra" id="des_tra" {{ $this->checkConfirmacion($contratacion) }}
                                    class="mt-1 block w-full sm:w-1/2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                </div>
                        
                                {{-- Mostrar los mensajes de error --}}
                                <div class="col-span-12 sm:col-span-12">
                                    <x-validation-errors></x-validation-errors>
                                </div>

                                <!-- Botón para enviar la propuesta -->
                                <button class="bg-green-500 text-white px-4 py-2 rounded" {{ $this->checkConfirmacion($contratacion) }}>Reenviar Propuesta</button>
                            </div>
                            @can('empresas.index')
                                <section class="absolute z-20 bottom-2 right-8">
                                    <x-button class="ml-4">
                                        <a wire:navigate href="{{ route('empresas.contrataciones.index') }}">
                                            {{ __('Volver') }}
                                        </a>
                                    </x-button>
                                </section>
                            @endcan
                        </section>
                    
                </form>                
            </div>
        </div>
    </div>
</div>
