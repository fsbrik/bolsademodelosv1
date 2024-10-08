<div class="py-3">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if (session()->has('message'))
                        <div x-data="{ open: true }" x-show="open"
                            class="relative p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                            role="alert">
                            <button @click="open = false"
                                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </button>
                            {{ session('message') }}
                        </div>
                @endif
                <table class="min-w-full bg-white mb-2">
                    <!-- Cabecera de la tabla -->
                    <thead>
                        <tr>
                            <!-- Columnas... -->
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">#</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Empresa</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Contacto</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Teléfono</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Lugar de trabajo</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Inicio</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Finalización</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Duración (días/horas)</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Monto (total/hora)</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Descripción</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Estado</th>
                            <th class="px-1 py-3 border-b-2 border-gray-300 text-left text-blue-500">Más info</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contrataciones as $contratacion)
                            <tr>
                                <!-- Filas de la tabla -->
                                <td class="px-1 py-3 border-b border-gray-300">{{ $contratacion->id }}</td>
                                <td class="px-1 py-3 border-b border-gray-300">{{ $contratacion->empresa->nom_com }}</td>
                                <td class="px-1 py-3 border-b border-gray-300">{{ $contratacion->empresa->user->name }}</td>
                                <td class="px-1 py-3 border-b border-gray-300">{{ $contratacion->empresa->user->telefono }}</td>
                                <td class="px-1 py-3 border-b border-gray-300">{{ $contratacion->loc_tra }}</td>
                                <td class="px-1 py-3 border-b border-gray-300">{{ $this->obtenerFechaFormateada($contratacion->fec_ini) }}</td>
                                <td class="px-1 py-3 border-b border-gray-300">{{ $this->obtenerFechaFormateada($contratacion->fec_fin) }}</td>
                                <td class="px-1 py-3 border-b border-gray-300">
                                    {{ $this->obtenerDiasTrabajo($contratacion) }} días / {{ $this->obtenerHorasTotales($contratacion) }} hrs
                                </td>                                
                                <td class="px-1 py-3 border-b border-gray-300">
                                    u$s {{ number_format($contratacion->mon_tot, 2) }} / u$s {{ number_format($this->obtenerCostoPorHora($contratacion), 2) }}
                                </td>
                                <td class="px-1 py-3 border-b border-gray-300">{{ $this->obtenerDescripcionCorta($contratacion) }}</td>
                                <td class="px-1 py-3 border-b border-gray-300">
                                    <!-- Confrimacion -->
                                <x-button wire:click="confirmar" wire:key="contratacion-{{ $contratacion->id }}" :class="$this->confirmacion_display($contratacion) == 'Pendiente' ? 'bg-slate-500' : ($this->confirmacion_display($contratacion) == 'Aceptado' ? 'bg-green-500' : 'bg-red-500')">{{ $this->confirmacion_display($contratacion) }}</x-button>
                                </td>

                                <td class="px-1 py-3 border-b border-gray-300">
                                    <a href="{{ route('modelos.contrataciones.show', $contratacion->id) }}" class="text-blue-600 hover:text-blue-900"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="px-1 py-3 text-center">No hay propuestas de contratación disponibles. </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Paginación (si usas paginate()) -->
                {{ $contrataciones->links() }}
                
            </div>
        </div>
    </div>
</div>
