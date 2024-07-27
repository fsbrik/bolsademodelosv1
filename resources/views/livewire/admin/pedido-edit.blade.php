<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar reserva') }}
        </h2>
    </x-slot>

    @if (Auth::user()->hasRole('admin'))
        @livewire('admin.pedido-user-search')
    @endif

    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form wire:submit.prevent="update">
                        @csrf
                        <h3 class="font-semibold text-lg text-gray-800 leading-tight">
                            {{ __('Reserva #: ') . $pedido['id'] }}
                        </h3>

                        <div class="flex justify-between">
                            <div class="flex-start w-40 bg-gray-100 grid mb-4 p-4">
                                <x-label for="fecha" value="{{ __('Fecha de la reserva (a confirmar)') }}" />
                                <x-input id="fecha" type="date" class="mt-1 block w-full"
                                    wire:model.live.debounce.250ms="fecha" />
                            </div>

                            @if (Auth::user()->hasRole('admin') && $selectedUser)
                                <div class="px-4 py-5 sm:p-6 mb-4 w-full sm:w-1/3 bg-green-400 shadow sm:rounded-lg">
                                    {{ __('Usuario seleccionado: ') . $selectedUser['name'] }}
                                </div>
                            @endif
                        </div>

                        <table class="min-w-full divide-y divide-gray-200 mt-2">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Denominación') }}
                                    </th>
                                    @if (Auth::user()->hasRole('admin'))
                                        <th scope="col"
                                            class="py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Categoría') }}
                                        </th>
                                    @endif
                                    <th scope="col"
                                        class="py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Descripción') }}
                                    </th>
                                    <th scope="col"
                                        class="py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Precio') }}
                                    </th>
                                    <th scope="col"
                                        class="py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Cantidad') }}
                                    </th>
                                    <th scope="col"
                                        class="py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Subtotal') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($servicios as $servicio)
                                    <tr>
                                        <td class="py-4 whitespace-nowrap">
                                            {{ $servicio->nom_ser }}
                                        </td>
                                        @if (Auth::user()->hasRole('admin'))
                                            <td class="py-4 whitespace-nowrap">
                                                {{ $servicio->cat_ser }}
                                            </td>
                                        @endif
                                        <td class="py-4 break-all">
                                            {{ $servicio->des_ser }}
                                        </td>
                                        <td class="py-4 whitespace-nowrap">
                                            {{ $servicio->precio }}
                                        </td>
                                        <td class="py-4 whitespace-nowrap">
                                            <x-input id="cantidad_{{ $servicio->id }}"
                                                class="block mt-1 w-1/3 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                type="text"
                                                wire:model.live.debounce.250ms="cantidad.{{ $servicio->id }}" />
                                            <x-input-error for="cantidad.{{ $servicio->id }}" class="mt-2" />
                                        </td>
                                        <td class="px-1 py-2 whitespace-wrap">
                                            {{ $subtotals[$servicio->id] ?? 0 }}
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
                                        <td class="p-4">{{ $total }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @can('pedidos.index')
                                <x-button class="ml-4">
                                    <a href="{{ route('pedidos.index') }}">
                                        {{ __('Volver') }}
                                    </a>
                                </x-button>
                            @endcan
                            @can('pedidos.edit')
                                <x-button class="ml-4">
                                    {{ __('Actualizar') }}
                                </x-button>
                            @endcan
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
