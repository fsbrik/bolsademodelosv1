<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles de la reserva') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight">
                        {{ __('Reserva #: ') . $pedido->id }}
                    </h3>
                    <p>{{ __('Fecha: ') . $pedido->fecha->format('d-m-Y') }}</p>
                    <p>{{ __('Total: ') . $pedido->total }}</p>

                    <h3 class="font-semibold text-lg text-gray-800 leading-tight mt-4">
                        {{ __('Servicios') }}
                    </h3>
                    @if ($servicios->count())
                        <table class="min-w-full divide-y divide-gray-200 mt-2">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Denominación') }}
                                    </th>
                                    @if ($pedido->user && $pedido->user->hasRole('admin'))
                                        <th scope="col"
                                            class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Categoría') }}
                                        </th>
                                    @endif
                                    <th scope="col"
                                        class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Descripción') }}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Precio') }}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Cantidad') }}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Subtotal') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($servicios as $servicio)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $servicio->nom_ser }}
                                        </td>
                                        @if ($pedido->user && $pedido->user->hasRole('admin'))
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $servicio->cat_ser }}
                                            </td>
                                        @endif
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $servicio->des_ser }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $servicio->precio }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $servicio->pivot->cantidad }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $servicio->precio * $servicio->pivot->cantidad }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="flex items-center justify-end mt-4 mr-4">
                            <div class="border border-gray-800 rounded-lg overflow-hidden">
                                <table class="w-40">
                                    <tr class="bg-gray-200">
                                        <td class="p-4">{{ __('Total') }}</td>
                                        <td class="p-4">{{ $pedido->total }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    @else
                        <p>{{ __('No se encontraron servicios para este pedido.') }}</p>
                    @endif
                    <div class="flex items-center justify-end mt-4">
                        @can('pedidos.edit')
                            <a href="{{ route('pedidos.edit', $pedido->id) }}"
                                class="text-yellow-600 hover:text-yellow-900 ml-4" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                        @endcan
                        @can('pedidos.destroy')
                            <form wire:submit="destroy({{ $pedido->id }})" class="inline ml-4">
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Borrar"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta reserva?');">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        @endcan
                        @can('pedidos.index')
                            <x-button class="ml-4">
                                <a wire:navigate href="{{ route('pedidos.index') }}">
                                    {{ __('Volver') }}
                                </a>
                            </x-button>
                        @endcan
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

