<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear nueva reserva') }}
        </h2>
    </x-slot>
    @if (Auth::user()->hasRole('admin'))
        @livewire('admin.pedido-user-search')
    @endif

    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center gap-2">
                        <div class="flex flex-wrap flex-col sm:flex-row">
                            {{-- Fecha de la reserva a confirmar --}}
                            <div class="bg-gray-100 mb-4 p-4">
                                <x-label for="fec_ini" value="{{ __('Fecha de la reserva (a confirmar)') }}" />
                                <x-input id="fec_ini" type="date" class="mt-1 block w-full"
                                    wire:model.live.debounce.250ms="fec_ini" />
                            </div>
                            {{-- En el caso que user tenga el rol de empresa --}}
                            @if($selectedUser && $selectedUser->hasRole('empresa'))
                                <div class="bg-gray-100 mb-4 p-4">
                                    <x-label for="empresa" value="{{ __('Empresa') }}" />
                                    <select id="empresa" class="mt-1 min-w-44 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm indent-1" wire:model.live.debounce.250ms="empresa">
                                            <option value="">{{ __('Seleccionar empresa') }}</option>
                                        @foreach($empresas as $empresa)
                                            <option value="{{ $empresa->id }}">{{ $empresa->nom_com }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>
                        @if (Auth::user()->hasRole('admin') && $selectedUser)
                            <div class="px-4 py-5 sm:p-6 mb-4 w-full sm:w-1/3 bg-green-400 shadow sm:rounded-lg">
                                {{ __('Usuario: ') . $selectedUser['name'] }} <br />
                                {{ __('Rol: ') . $selectedUser->roles->first()->name }}
                            </div>
                        @endif
                    </div>

                    <x-input-error for="selectedUser" class="mt-2" />

                    <form wire:submit.prevent="submit">
                        @csrf

                        @if ($servicios->count())
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        {{-- <th scope="col"
                                            class="px-1 py-2 text-left font-medium text-gray-500 uppercase ">
                                            {{ __('#') }}
                                        </th> --}}
                                        <th scope="col"
                                            class="px-1 py-2 text-left font-medium text-gray-500 uppercase ">
                                            {{ __('Denominacion') }}
                                        </th>
                                        {{-- @if (isset($selectedUser) && $selectedUser->hasRole('admin')) --}}
                                        @if (Auth::user()->hasRole('admin'))
                                            <th scope="col"
                                                class="px-1 py-2 text-left font-medium text-gray-500 uppercase ">
                                                {{ __('Categoría') }}
                                            </th>
                                        @endif
                                        <th scope="col"
                                            class="px-1 py-2 text-left font-medium text-gray-500 uppercase ">
                                            {{ __('Descripción') }}
                                        </th>
                                        <th scope="col"
                                            class="px-1 py-2 text-left font-medium text-gray-500 uppercase ">
                                            {{ __('Precio') }}
                                        </th>
                                        <th scope="col"
                                            class="px-1 py-2 text-left font-medium text-gray-500 uppercase ">
                                            {{ __('Cant.') }}
                                        </th>
                                        <th scope="col"
                                            class="px-1 py-2 text-left font-medium text-gray-500 uppercase ">
                                            {{ __('Subtotal') }}
                                        </th>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($servicios as $index => $servicio)
                                        <tr wire:key="servicio-{{ $servicio->id }}">
                                            {{-- <td class="px-1 py-2 whitespace-nowrap">
                                                <x-input id="seleccionar.{{ $index }}"
                                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    type="checkbox" wire:model="seleccionar.{{ $index }}"
                                                    step="500" />
                                            </td> --}}
                                            <td class="px-1 py-2 whitespace-nowrap">
                                                {{ $servicio->nom_ser }}
                                            </td>
                                            {{-- @if (isset($selectedUser) && $selectedUser->hasRole('admin')) --}}
                                            @if (Auth::user()->hasRole('admin'))
                                                <td class="px-1 py-2 whitespace-nowrap">
                                                    {{ $servicio->cat_ser }}
                                                </td>
                                            @endif
                                            <td class="px-1 py-2 break-all">
                                                {{ $servicio->des_ser }}
                                            </td>
                                            <td class="px-1 py-2 whitespace-wrap">
                                                {{ $servicio->precio }}
                                            </td>
                                            <td class="px-1 py-2 whitespace-nowrap">
                                                <x-input id="cantidad.{{ $index }}"
                                                    class="block mt-1 w-1/3 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    type="text"
                                                    wire:model.live.debounce.1000ms="cantidad.{{ $index }}" />
                                                <x-input-error for="cantidad.{{ $index }}" class="mt-2" />
                                            </td>
                                            <td class="px-1 py-2 whitespace-wrap">
                                                {{ $subtotals[$servicio->id] ?? 0 }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if (session()->has('error'))
                                    <div class="flex items-center justify-between mt-4 mr-4">
                                @else
                                    <div class="flex items-center justify-end mt-4 mr-4">
                            @endif
                            @if (session()->has('error'))
                                <div class="mt-4 text-red-500 justify-self-start">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="border border-gray-800 rounded-lg overflow-hidden">
                                <table class="w-40">
                                    <tr class="bg-gray-200">
                                        <td class="p-4">{{ __('Total') }}</td>
                                        <td class="p-4">{{ $total }}</td>
                                    </tr>
                                </table>
                            </div>
                </div>

                @endif

                <div class="flex items-center justify-end mt-4">
                    @can('pedidos.index')
                        <x-button class="ml-4">
                            <a href="{{ route('pedidos.index') }}">
                                {{ __('Volver') }}
                            </a>
                        </x-button>
                        <x-button class="ml-4">
                            {{ __('Reservar') }}
                        </x-button>
                    </div>
                @endcan
                </form>
                @if (session()->has('message'))
                    <div class="mt-4 text-green-500">
                        {{ session('message') }}
                    </div>
                @endif


            </div>
        </div>
    </div>
</div>
</div>
