<div>
    <div>
        <img src="{{ $profile_photo_url }}" alt="{{ $modelo['mod_id'] }}" class="rounded-xl mb-4 w-28 h-40 object-cover" />
    </div>
    <div class="grid grid-cols-1 md:grid md:grid-cols-12 md:gap-2">
        <!-- Mod Id -->
        <div class="col-span-12 sm:col-span-12 mb-2">
            <x-label for="mod_id" value="{{ __('ID de la modelo: ') }}" class="inline-block"/>
            <span class="indent-1 rounded-xl bg-yellow-300 p-2">{{ __( '##'.$modelo['mod_id']) }}</span>
        </div>

        <!-- Fecha de Nacimiento -->
        <div class="col-span-12 sm:col-span-2">
            <x-label for="fec_nac" value="{{ __('Fecha de Nacimiento') }}" />
            <span class="rounded-md border border-gray-300 p-2 text-[11px] block mt-1 min-h-[33px]">{{ __( $modelo['fec_nac']) }}</span>
            {{-- <x-input id="fec_nac" type="date" class="mt-1 block w-full" wire:model="modelo.fec_nac" disabled /> --}}
        </div>

        <!-- Sexo -->
        <div class="col-span-12 sm:col-span-1">
            <x-label for="sexo" value="{{ __('Sexo') }}" />
            <span class="rounded-md border border-gray-300 p-2 text-[11px] block mt-1 min-h-[33px]">{{ $this->sexo_display }}</span>
            {{-- <x-input id="sexo" type="text" class="mt-1 block w-full" value="{{ $this->sexo_display }}" disabled /> --}}
        </div>

        <!-- Estatura -->
        <div class="col-span-12 sm:col-span-1">
            <x-label for="estatura" value="{{ __('Estatura') }}" />
            <span class="rounded-md border border-gray-300 p-2 text-[11px] block mt-1 min-h-[33px]">{{ __( $modelo['estatura']) }}</span>
            {{-- <x-input id="estatura" type="number" class="mt-1 block w-full" wire:model="modelo.estatura" step="0.01" disabled /> --}}                
        </div>

        <!-- Color del cabello -->
        <div class="col-span-12 sm:col-span-2">
            <x-label for="col_cab" value="{{ __('Color del cabello') }}" />
            <span class="rounded-md border border-gray-300 p-2 text-[11px] block mt-1 min-h-[33px]">{{ $this->colcab_display }}</span>
            {{-- <x-input id="col_cab" type="text" class="mt-1 block w-2/3" wire:model="modelo.col_cab" disabled /> --}}
        </div>

        <!-- Medidas -->
        <div class="col-span-12 sm:col-span-1">
            <x-label for="medidas" value="{{ __('Medidas') }}" />
            <span class="rounded-md border border-gray-300 p-2 text-[11px] block mt-1 min-h-[33px]">{{ __( $modelo['medidas']) }}</span>
            {{-- <x-input id="medidas" type="text" class="mt-1 block w-full" wire:model="modelo.medidas" disabled /> --}}
        </div>

        <!-- Calzado -->
        <div class="col-span-12 sm:col-span-1">
            <x-label for="calzado" value="{{ __('Calzado') }}" />
            <span class="rounded-md border border-gray-300 p-2 text-[11px] block mt-1 min-h-[33px]">{{ __( $modelo['calzado']) }}</span>
            {{-- <x-input id="calzado" type="text" class="mt-1 block w-2/3" wire:model="modelo.calzado" disabled /> --}}
        </div>

        <!-- Zona de Residencia -->
        <div class="col-span-12 sm:col-span-4">
            <x-label for="zon_res" value="{{ __('Zona de Residencia') }}" />
            <span class="rounded-md border border-gray-300 p-2 text-[11px] block mt-1 min-h-[33px]">{{ __( $modelo['zon_res']) }}</span>
            {{-- <x-input id="zon_res" type="text" class="mt-1 block w-1/2" wire:model="modelo.zon_res" disabled /> --}}           
        </div>

        <!-- Disponibilidad para viajar -->
        <div class="col-span-12 sm:col-span-2">
            <x-label for="dis_via" value="{{ __('Disponibilidad para Viajar') }}" />
            <span class="rounded-md border border-gray-300 p-2 text-[11px] block mt-1 min-h-[33px]">{{ $this->disvia_display }}</span>
            {{-- <x-input id="dis_via" type="text" class="mt-1 block w-1/3" value="{{ $this->disvia_display }}" disabled /> --}}                
        </div>

        <!-- Título de Modelo -->
        <div class="col-span-12 sm:col-span-2">
            <x-label for="tit_mod" value="{{ __('Título de Modelo') }}" />
            <span class="rounded-md border border-gray-300 p-2 text-[11px] block mt-1 min-h-[33px]">{{ $this->titmod_display }}</span>
            {{-- <x-input id="tit_mod" type="text" class="mt-1 block w-1/3" value="{{ $this->titmod_display }}" disabled /> --}}                
        </div>

        <!-- Nivel de inglés -->
        <div class="col-span-12 sm:col-span-2">
            <x-label for="ingles" value="{{ __('Nivel de Inglés') }}" />
            <span class="rounded-md border border-gray-300 p-2 text-[11px] block mt-1 min-h-[33px]">{{ $this->ingles_display }}</span>
            {{-- <x-input id="ingles" type="text" class="mt-1 block w-1/2" wire:model="modelo.ingles" disabled /> --}}
        </div>

        <!-- Disponible para trabajos -->
        <div class="col-span-12 sm:col-span-6">
            <x-label for="dis_tra" value="{{ __('Disponible para trabajos de') }}" />
            <span class="rounded-md border border-gray-300 p-2 text-[11px] block mt-1 min-h-[33px]">{{ $this->distra_display }}</span>
            {{-- <x-input id="dis_tra" type="text" class="mt-1 block w-1/2" wire:model="modelo.dis_tra" disabled /> --}}
        </div>

        <!-- Descripción -->
        <div class="col-span-12 sm:col-span-12">
            <x-label for="descripcion" value="{{ __('Descripción') }}" />
            <span class="rounded-md border border-gray-300 p-2 text-[11px] block mt-1 min-h-[33px]">{{ __( $modelo['descripcion']) }}</span>
            {{-- <textarea id="descripcion" wire:model="modelo.descripcion" disabled
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea> --}}
        </div>

        <!-- Tarifa por media jornada -->
        <div class="col-span-12 sm:col-span-3">
            <x-label for="tar_med" value="{{ __('Tarifa por media jornada (U$S)') }}" />
            <span class="rounded-md border border-gray-300 p-2 text-[11px] block mt-1 min-h-[33px]">{{ __( $modelo['tar_med']) }}</span>
            {{-- <x-input id="tar_med" type="number" class="mt-1 block w-1/3" wire:model="modelo.tar_med" step="0.01" disabled /> --}}               
        </div>

        <!-- Tarifa por jornada completa -->
        <div class="col-span-12 sm:col-span-9">
            <x-label for="tar_com" value="{{ __('Tarifa por jornada completa (U$S)') }}" />
            <span class="rounded-md border border-gray-300 p-2 text-[11px] block mt-1 min-h-[33px]">{{ __( $modelo['tar_com']) }}</span>
            {{-- <x-input id="tar_com" type="number" class="mt-1 block w-1/9" wire:model="modelo.tar_com" step="0.01" disabled /> --}}
        </div>

        <!-- Estado -->
        @can('modelos.ver_estado')
            <div class="col-span-12 sm:col-span-1">
                <x-label for="estado" value="{{ __('Estado') }}" />
                <span class="rounded-md border border-gray-300 p-2 text-[11px] block mt-1 min-h-[33px] {{$modelo['estado'] == 1 ? 'bg-green-500 mt-1 block w-full' : 'bg-red-500 mt-1 block w-full'}}">
                    {{ $this->estado_display }}</span>
                {{-- <x-input id="estado" type="text" :class="$modelo['estado'] == 1 ? 'bg-green-500 mt-1 block w-full' : 'bg-red-500 mt-1 block w-full'" value="{{ $this->estado_display }}" disabled /> --}}
            </div>
        @endcan

        <!-- Habilitar -->
        @can('modelos.ver_habilitar')
            <div class="col-span-12 sm:col-span-11">
                <x-label for="habilita" value="{{ __('Habilitado?') }}" />
                <span class="rounded-md border border-gray-300 p-2 text-[11px] block mt-1 min-h-[33px]">{{ $this->habilita_display }}</span>
                {{-- <x-input id="habilita" type="text" class="mt-1 block w-8" value="{{ $this->habilita_display }}" disabled />   --}}                  
            </div>
        @endcan

    </div>
    <x-section-border />

    <div class="flex items-center justify-end mt-4">
        <i class="fas fa-image text-success cursor-pointer"
            wire:click="$dispatch('openGallery', { modeloId: {{ $modeloId }} })"></i>
        {{-- Seleccionar o remover modelo --}}
        @can('empresas.contratar_modelos')                                                                
            <section class="inline ml-2">
                @if(in_array($modelo['mod_id'], $modelosSeleccionadas))
                    {{-- Botón para remover el modelo --}}
                    <button wire:click="removeModelo({{ $modelo['id'] }})"
                        class="text-red-600 hover:text-red-900"
                        title="Remover">
                        <i class="fas fa-circle-minus"></i>
                    </button>
                @else
                    {{-- Botón para seleccionar el modelo --}}
                    <button wire:click="addModeloSeleccionada({{ $modelo['id'] }})"
                        class="text-green-600 hover:text-green-900"
                        title="Seleccionar">
                        <i class="fas fa-add"></i>
                    </button>
                @endif
            </section>
        @endcan
        @can('modelos.edit')
            <a href="{{ route('modelos.edit', $modelo['id']) }}" class="text-yellow-600 hover:text-yellow-900 ml-4"
                title="Editar">
                <i class="fas fa-edit"></i>
            </a>
        @endcan
        @can('modelos.destroy')
            <form action="{{ route('modelos.destroy', $modelo['id']) }}" method="POST" class="inline ml-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-900" title="Borrar"
                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta modelo?');">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
        @endcan
        @if(!Auth::user()->hasRole('modelo'))
            <x-button class="ml-4">
                <a href="{{ route('modelos.index') }}">
                    {{ __('Volver') }}
                </a>
            </x-button>
        @endif
    </div>
    {{-- Abre el modal con la galeria de fotos de la modelo seleccionada --}}
    @livewire('modelo-galeria')
</div>
