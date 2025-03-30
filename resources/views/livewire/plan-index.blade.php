<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Plan contratado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-1 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- @if (Auth::user()->hasRole('admin'))
                        <x-input wire:model.live.debounce.250ms="searchTerm" type="text"
                            placeholder="Buscar reservas..." class="mb-4" />
                    @endif --}}

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

                    @if (isset($plan))
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('ID') }}
                                    </th>
                                    @if (Auth::user()->hasRole('admin'))
                                        <th scope="col"
                                            class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Categoría') }}
                                        </th>
                                        <th scope="col"
                                            class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Usuario') }}
                                        </th>
                                    @endif
                                    <th scope="col"
                                        class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Plan contratado') }}
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Fecha de inicio') }}
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Vencimiento') }}
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Créditos disponibles') }}
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Total') }}
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Estado') }}
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Acciones') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-1 py-2 whitespace-nowrap">
                                            {{ $plan->id }}
                                        </td>
                                        @if (Auth::user()->hasRole('admin'))
                                            <td class="px-1 py-2 whitespace-nowrap">
                                                {{ $plan->servicios->first()->cat_ser ?? 'N/A' }}
                                            </td>
                                            <td class="px-1 py-2 whitespace-nowrap">
                                                {{ $plan->user->name }}
                                            </td>
                                        @endif
                                        <td class="px-1 py-2 whitespace-nowrap">
                                            {{ $plan->servicios->first()->nom_ser }}
                                        </td>
                                        <td class="px-1 py-2 whitespace-nowrap">
                                            {{ $plan->fec_ini ? \Carbon\Carbon::parse($plan->fec_ini)->format('d-m-Y') : '-' }}
                                        </td>
                                        <td class="px-1 py-2 whitespace-nowrap">
                                            {{ $plan->fec_fin ? \Carbon\Carbon::parse($plan->fec_fin)->format('d-m-Y') : '-' }}
                                        </td>
                                        <td class="px-1 py-2 whitespace-nowrap">
                                            {{ $this->mostrarCreditos($plan) }}
                                        </td>
                                        <td class="px-1 py-2 whitespace-nowrap">
                                            {{ $plan->total }}
                                        </td>
                                        <td class="px-1 py-2 whitespace-nowrap">
                                            {{ $plan->habilita == 1 ? 'habilitado' : 'no habilitado' }}
                                        </td>
                                        <td class="px-1 py-2 whitespace-nowrap text-sm font-medium">
                                            
                                            @if($this->getHabilita($plan))
                                                <a href="{{ route('planes.edit', $plan->id) }}"
                                                    class="inline-flex items-center px-2 py-0 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'" title="Modificar plan">
                                                    {{ __('Modificar plan')}}
                                                </a>
                                            @endif
                                                
                                            <a href="{{ route('planes.show', $plan->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900" title="Ver plan"
                                                wire:navigate>
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @if($this->getHabilita($plan))
                                                <form wire:submit="destroy({{ $plan->id }})" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                                        title="Desuscribirse"
                                                        onclick="return confirm('¿Estás seguro de que deseas eliminar el plan a contratar?');">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                        {{-- @can('planes.create')
                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4">
                                    <a wire:navigate href="{{ route('planes.create') }}">
                                        {{ __('Generar otra reserva') }}
                                    </a>
                                </x-button>
                            </div>
                        @endcan --}}
                    @else
                        <!-- En caso que todavía no haya ningun plan creado -->
                        <div class="flex items-center justify-end mt-4">
                            <h3 class="flex-grow font-medium text-gray-800 leading-tight text-left">No tenés ningún plan contratado aún</h3>
                            <x-button class="ml-4">
                                <a wire:navigate href="{{ route('planes.create') }}">
                                    {{ __('Contratar un plan') }}
                                </a>
                            </x-button>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
