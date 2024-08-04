<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resevas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if (Auth::user()->hasRole('admin'))
                        <x-input wire:model.live.debounce.250ms="searchTerm" type="text"
                            placeholder="Buscar reservas..." class="mb-4" />
                    @endif
                    @if ($pedidos->count())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
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
                                            class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Categoría') }}
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Usuario') }}
                                        </th>
                                    @endif
                                    <th scope="col"
                                        class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        <button wire:click="sortBy('fecha')" class="flex items-center">
                                            {{ __('Fecha') }}
                                            @if ($sort_by === 'fecha')
                                                @if ($sortDirection === 'asc')
                                                    <span class="ml-1 text-green-500">↑</span>
                                                @else
                                                    <span class="ml-1 text-red-500">↓</span>
                                                @endif
                                            @endif
                                        </button>
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Total') }}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Acciones') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($pedidos as $pedido)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $pedido->id }}
                                        </td>
                                        @if (Auth::user()->hasRole('admin'))
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $pedido->servicios->first()->cat_ser ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $pedido->user->name }}
                                            </td>
                                        @endif
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($pedido->fecha)->format('d-m-Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $pedido->total }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
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
                                            <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
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
                                        {{ __('Crear otra reserva') }}
                                    </a>
                                </x-button>
                            </div>
                        @endcan
                    @else
                        <!-- En caso que todavía no haya ninguna empresa creada -->
                        <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
                            <div class="p-4">
                                <h2 class="text-xl font-semibold text-gray-800">Realizá tu reserva/contratación</h2>
                                @can('pedidos.create')
                                    <div class="flex items-center justify-end mt-4">
                                        <x-button class="ml-4">
                                            <a wire:navigate href="{{ route('pedidos.create') }}">
                                                {{ __('Crear reserva') }}
                                            </a>
                                        </x-button>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
