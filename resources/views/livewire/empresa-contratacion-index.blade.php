<div class="py-3">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if (session()->has('message'))
                        <div x-data="{ open: true }" x-show="open"
                            class="relative p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                            <button @click="open = false"
                                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </button>
                            {{ session('message') }}
                        </div>
                @endif
                @if (session()->has('error'))
                        <div x-data="{ open: true }" x-show="open"
                            class="relative p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                            <button @click="open = false"
                                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </button>
                            {{ session('error') }}
                        </div>
                @endif
                <table class="min-w-full bg-white mb-2">@php dump('habilitado: ' . ($this->planContratado->habilita ?? 'null'), 'creditos: ' . ($this->planContratado->creditos ?? 'null'), 'conf_ini: '.($this->planContratado->conf_ini ?? 'null')) @endphp
                    <!-- Cabecera de la tabla -->
                    <thead>
                        <tr>
                            <!-- Columnas... -->
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">#</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Fecha</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Empresa</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Inicio</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Finalización</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Duración<br>(días/horas)</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Modelos<br>seleccionadas</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Costo<br>(total/hora)</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Descripción</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Confirmaciones</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Acciones</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contrataciones as $contratacion)
                            <tr>
                                <!-- Filas de la tabla -->
                                <td class="px-1 py-3 border-b border-gray-300">{{ $contratacion->id }}</td>
                                <td class="px-1 py-3 border-b border-gray-300">{{ $this->obtenerFechaFormateada($contratacion->fec_con) }}</td>
                                <td class="px-1 py-3 border-b border-gray-300">{{ $contratacion->empresa->nom_com }}</td>
                                <td class="px-1 py-3 border-b border-gray-300">{{ $this->obtenerFechaFormateada($contratacion->fec_ini) }}</td>
                                <td class="px-1 py-3 border-b border-gray-300">{{ $this->obtenerFechaFormateada($contratacion->fec_fin) }}</td>
                                <td class="px-1 py-3 border-b border-gray-300">
                                    {{ $this->obtenerDiasTrabajo($contratacion) }} días / {{ $this->obtenerHorasTotales($contratacion) }} hrs
                                </td>
                                <td class="px-1 py-3 border-b border-gray-300 text-center">{{ $contratacion->modelos->count() }}</td>
                                <td class="px-1 py-3 border-b border-gray-300">
                                    u$s {{ number_format($contratacion->mon_tot, 2) }} / u$s {{ number_format($this->obtenerCostoPorHora($contratacion), 2) }}
                                </td>
                                <td class="px-1 py-3 border-b border-gray-300">{{ $this->obtenerDescripcionCorta($contratacion) }}</td>
                                <td class="px-1 py-3 border-b border-gray-300 text-center">
                                    {{ $this->obtenerModelosConfirmados($contratacion) }} / {{ $contratacion->cant_mod }}
                                </td>

                                <td class="px-1 py-3 border-b border-gray-300">
                                    <a href="{{ route('empresas.contrataciones.show', $contratacion->id) }}" class="text-blue-600 hover:text-blue-900"><i class="fas fa-eye"></i></a>
                                    {{-- en el caso que la empresa no haya pagado un plan, no va a poder contratar, ni editar, ni eliminar--}}
                                    @if(isset($this->planContratado) && $this->planContratado->habilita) 
                                        {{-- en el caso que la fec_fin de la contratacion se haya vencido (false) y que alguna modelo haya confirmado (false)--}}
                                        @if($this->checkConfirmacion($contratacion) || !$this->checkFecFinContratacion($contratacion))
                                            <a href="{{ route('empresas.contrataciones.edit', $contratacion->id) }}" class="text-yellow-600 hover:text-yellow-900">
                                            <i class="fas fa-edit"></i></a>
                                        @endif
                                            {{-- @if($this->checkConfirmacion($contratacion) || $this->checkFecFinContratacion($contratacion))
                                            @endif --}}
                                        {{-- solo se puede eliminar la contratacion cuando no haya ninguna confirmación y mientras no se haya vencido la contratacion --}}
                                        @if($this->checkConfirmacion($contratacion)/*  && $this->checkFecFinContratacion($contratacion) */)
                                            <form wire:submit="destroy({{$contratacion->id}})" class="inline">
                                                <button type="submit" class="text-red-600 hover:text-red-900" title="Borrar"
                                                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta propuesta de contratación?');">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </td>
                                <td class="px-1 py-3 border-b border-gray-300 {{ $this->obtenerClaseEstado($contratacion) }}">
                                    {{ $this->obtenerEstadoContratacion($contratacion) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="px-1 py-3 text-center">No hay contrataciones disponibles.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Paginación (si usas paginate()) -->
                {{ $contrataciones->links() }}

                {{-- para poder crear o editar contrataciones, tiene que tener un plan habilitado --}}
                @if(isset($this->planContratado) && $this->planContratado->habilita) 
                    <div class="flex items-center justify-end mt-4">
                        {{-- determinar si proviene de crear o editar --}}
                        @if ($action === 'contratEdit')
                        <a href="{{ route('empresas.contrataciones.edit', $contratacionId) }}" 
                            {{-- onclick="return confirm('Tenés una contratación pendiente, ¿Querés continuarla?')" --}}
                            class="bg-gray-800 text-white px-4 py-3 rounded ml-2 mb-4 hidden sm:block">
                            {{ __('Continuar editando') }}
                        </a>
                        @if($this->checkCreditos() && $this->checkCreditos())
                        <a href="{{ route('empresas.contrataciones.create') }}" 
                            onclick="return confirm('Tenés una contratación pendiente. Hacé click en \'CANCELAR\' y luego en el botón de \'CONTINUAR EDITANDO\' para retormarla, de lo contrario vas a perder los cambios')"
                            class="bg-gray-800 text-white px-4 py-3 rounded ml-2 mb-4 hidden sm:block">
                            {{ __('Nueva contratación') }}
                        </a>
                        @endif
                        @elseif ($action === 'contratCreateNew' && $this->checkCreditos())
                        <a href="{{ route('empresas.contrataciones.create') }}" 
                            class="bg-gray-800 text-white px-4 py-3 rounded ml-2 mb-4 hidden sm:block">
                            {{ __('Nueva contratación') }}
                        </a>
                        @elseif ($action === 'contratCreate' && $this->checkCreditos())                    
                        <a href="{{ route('empresas.contrataciones.create') }}"
                            class="bg-gray-800 text-white px-4 py-3 rounded ml-2 mb-4 hidden sm:block">
                            {{ __('Continuar con la contratación') }}
                        </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
