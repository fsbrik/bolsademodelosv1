<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resevas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-1 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if (Auth::user()->hasRole('admin'))
                        <x-input wire:model.live.debounce.250ms="searchTerm" type="text"
                            placeholder="Buscar reservas..." class="mb-4" />
                    @endif

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
                                    @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('empresa'))
                                        <th scope="col"
                                            class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Empresa') }}
                                        </th>
                                    @endif
                                    <th scope="col"
                                        class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        <button wire:click="sortBy('fec_ini')" class="flex items-center">
                                            {{ __('Fecha') }}
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
                                        class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Total') }}
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Acciones') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($pedidos as $pedido)
                                    <tr>
                                        <td class="px-1 py-2 whitespace-nowrap">
                                            {{ $pedido->id }}
                                        </td>
                                        @if (Auth::user()->hasRole('admin'))
                                            <td class="px-1 py-2 whitespace-nowrap">
                                                {{ $pedido->servicios->first()->cat_ser ?? 'N/A' }}
                                            </td>
                                            <td class="px-1 py-2 whitespace-nowrap">
                                                {{ $pedido->user->name }}
                                            </td>
                                        @endif
                                        @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('empresa'))
                                            <th scope="col"
                                                class="px-1 py-3 text-left font-medium text-gray-500 tracking-wider">
                                                {{ $this->empresaPedido($pedido) }}
                                            </th>
                                        @endif
                                        <td class="px-1 py-2 whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($pedido->fec_ini)->format('d-m-Y') }}
                                        </td>
                                        <td class="px-1 py-2 whitespace-nowrap">
                                            {{ $pedido->total }}
                                        </td>
                                        <td class="px-1 py-2 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('pedidos.show', $pedido->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900" title="Ver"
                                                wire:navigate>
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('pedidos.edit', $pedido->id) }}"
                                                class="text-yellow-600 hover:text-yellow-900" title="Editar"
                                                wire:navigate>
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form wire:submit="destroy({{ $pedido->id }})" class="inline">
                                                @csrf
                                                <button type="submit" class="text-red-600 hover:text-red-900"
                                                    title="Borrar"
                                                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta reserva?');">
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
                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4">
                                    <a wire:navigate href="{{ route('pedidos.create') }}">
                                        {{ __('Generar otra reserva') }}
                                    </a>
                                </x-button>
                            </div>
                        @endcan
                    @else
                        <!-- En caso que todavía no haya ninguna empresa creada -->
                        <div class="flex flex-col lg:flex-row flex-wrap items-stretch">
                            <div
                                class="w-full flex-1 p-2 mb-2 md:mb-0 bg-gray-300 shadow-lg rounded-lg box-border order-2 lg:order-1">
                                <h3 class="mx-2 mt-1 font-medium text-xl">Te presentamos el estudio fotográfico</h3>
                                <img src="{{ asset('storage/estudio/estudio.jpg') }}" class="p-2 shadow-sm rounded-3xl"
                                    alt="el_estudio_fotografico">
                            </div>
                            <div
                                class="w-full  flex-1 mx-0 lg:mx-2 bg-gray-200 flex flex-wrap items-stretch shadow-lg rounded-lg order-1 lg:order-2">
                                <div class="flex flex-wrap p-4 order-1">
                                    <div
                                        class="hidden lg:inline-flex w-full lg:w-1/3 xl:w-1/6 h-1/6 lg:h-2/3 lg:self-center lg:mr-2 flex-none bg-teal-500 rounded-full">
                                    </div>
                                    <div
                                        class="w-full lg:w-2/3 xl:w-5/6 lg:mx-1 lg:flex-1 bg-white shadow-lg rounded-lg overflow-hidden">
                                        <div class="p-4">
                                            <h2 class="text-xl font-semibold text-gray-800">Realizá tu reserva</h2>
                                            <p>Te presentamos el estudio de fotografía. Solicitá acá un turno para tu
                                                sesión
                                                de fotos.</p>
                                            @can('pedidos.create')
                                                <div class="flex items-center justify-end mt-4">
                                                    <x-button class="ml-4">
                                                        <a wire:navigate href="{{ route('pedidos.create') }}">
                                                            {{ __('Reservar') }}
                                                        </a>
                                                    </x-button>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                                <div class="my-2 lg:mt-0 order-2">
                                    <h3 class="mx-2 mt-1 font-medium text-xl">Equipos utilizados</h3>
                                    <img src="{{ asset('storage/equipamiento/equipamiento.jpg') }}"
                                        class="p-2 shadow-sm rounded-3xl" alt="equipos_fotograficos">
                                </div>
                            </div>
                        </div>


                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
