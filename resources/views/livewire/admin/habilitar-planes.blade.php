<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resevas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-1 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                        <x-input wire:model.live.debounce.250ms="searchTerm" type="text"
                            placeholder="Buscar..." class="mb-4" />

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

                    @if (session()->has('selectedUserError'))
                        <div x-data="{ open: true }" x-show="open"
                            class="relative p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg"  role="alert">
                            <button @click="open = false"
                                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </button>
                            {{ session('selectedUserError') }}
                        </div>
                    @endif

                    @if ($pedidos->count())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        <button wire:click="sortBy('id')" class="flex items-center">
                                            {{ __('ID') }}
                                            @if ($sort_by === 'id')
                                                @if ($sortDirection === 'asc')
                                                    <span class="ml-1 text-green-500">↑</span>
                                                @else
                                                    <span class="ml-1 text-red-500">↓</span>
                                                @endif
                                            @endif
                                        </button>
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Usuario') }}
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Teléfono') }}
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Plan seleccionado') }}
                                    </th>                                    
                                    <th scope="col"
                                        class="px-1 py-3 text-left font-medium text-gray-500 tracking-wider">
                                        <button wire:click="sortBy('fec_ini')" class="flex items-center uppercase">
                                            {{ __('Inicio') }}
                                            @if ($sort_by === 'fec_ini')
                                                @if ($sortDirection === 'asc')
                                                    <span class="ml-1 text-green-500">↑</span>
                                                @else
                                                    <span class="ml-1 text-red-500">↓</span>
                                                @endif
                                            @endif
                                        </button>
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-3 text-left font-medium text-gray-500 tracking-wider">
                                        <button wire:click="sortBy('fec_fin')" class="flex items-center uppercase">
                                            {{ __('Finalización') }}
                                            @if ($sort_by === 'fec_fin')
                                                @if ($sortDirection === 'asc')
                                                    <span class="ml-1 text-green-500">↑</span>
                                                @else
                                                    <span class="ml-1 text-red-500">↓</span>
                                                @endif
                                            @endif
                                        </button>
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Creditos') }}
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Total') }}
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-3 text-left font-medium text-gray-500 tracking-wider">
                                        <button wire:click="sortBy('habilita')" class="flex items-center uppercase">
                                            {{ __('Habilitar') }}
                                            @if ($sort_by === 'habilita')
                                                @if ($sortDirection === 'asc')
                                                    <span class="ml-1 text-green-500">↑</span>
                                                @else
                                                    <span class="ml-1 text-red-500">↓</span>
                                                @endif
                                            @endif
                                        </button>
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Acciones') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($pedidos as $pedido)
                                    <tr wire:key="pedido-{{ $pedido->id }}" class="{{ $pedido->habilita === 0 ? 'bg-red-500' : '' }}" >
                                        <td class="px-1 py-2 whitespace-nowrap">
                                            {{ $pedido->id }}
                                        </td>
                                        <td class="px-1 py-2 whitespace-nowrap">
                                            {{ $pedido->user->name }}
                                        </td>
                                        <td class="px-1 py-2 whitespace-nowrap">
                                            {{ $pedido->user->telefono }}
                                        </td>
                                        <td class="px-1 py-2 whitespace-nowrap">
                                            {{ $pedido->servicios->first()->nom_ser ?? 'N/A' }}
                                        </td>                                        
                                        <td class="px-1 py-2 whitespace-nowrap">
                                            {{ $pedido->fec_ini ?? '-' }}
                                        </td>
                                        <td class="px-1 py-2 whitespace-nowrap">
                                            {{ $pedido->fec_fin ?? '-' }}
                                        </td>
                                        <td class="px-1 py-2 whitespace-nowrap">
                                            {{ $this->mostrarCreditos($pedido) }}
                                        </td>
                                        <td class="px-1 py-2 whitespace-nowrap">
                                            {{ $pedido->total }}
                                        </td>
                                        <td class="px-1 py-2 whitespace-wrap">
                                            <div class="col-span-6 sm:col-span-4 flex items-center">
                                                @if($pedido->habilita) 
                                                <form wire:submit="habilitarPlan({{ $pedido->id }})" class="inline">
                                                    @csrf
                                                    <x-button type="submit" id="habilita" class="label-small"
                                                        onclick="return confirm('¿Estás seguro de que deseas deshabilitar el plan contratado?')">                                                    
                                                        {{ __('Deshabilitar') }}
                                                    </x-button>
                                                </form>
                                                @else
                                                    <x-button id="habilita" class="label-small {{ $pedido->habilita === null ? '' : 'bg-sky-900' }}" wire:click="habilitarPlan({{ $pedido->id }})">
                                                        {{ $pedido->habilita === null ? 'Habilitar' : 'Rehabilitar' }}
                                                    </x-button>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-1 py-2 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('planes.show', $pedido->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900" title="Ver"
                                                wire:navigate>
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('planes.edit', $pedido->id) }}"
                                                class="text-yellow-600 hover:text-yellow-900" title="Editar"
                                                wire:navigate>
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form wire:submit="destroy({{ $pedido->id }})" class="inline">
                                                @csrf
                                                <button type="submit" class="text-red-600 hover:text-red-900"
                                                    title="Borrar"
                                                    onclick="return confirm('¿Estás seguro de que deseas eliminar el plan contratado?');">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $pedidos->links() }}
                        @can('pedidos.create')
                            @if(Auth::user()->hasRole('admin'))
                                <div class="flex items-center justify-end mt-4">
                                    <x-button class="ml-4">
                                        <a wire:navigate href="{{ route('planes.create') }}">
                                            {{ __('Generar otro plan') }}
                                        </a>
                                    </x-button>
                                </div>
                            @endif
                        @endcan
                    @else
                        <div class="flex items-stretch m-2">
                            <div class="bg-white shadow-md rounded-lg overflow-hidden flex items-center px-4">
                                <p class="text-justify font-medium text-xl">No hay planes contratados</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
