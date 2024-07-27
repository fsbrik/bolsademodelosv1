<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pedidos') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-2/3 mx-auto bg-gray-100 grid grid-cols-9 gap-2 mb-4 p-4">                        
                        <div class="col-span-9 sm:col-span-3">
                            <x-label for="searchName" value="{{ __('Nombre / apellido') }}" />
                            <x-input id="searchName" type="text" class="mt-1 block w-full"
                                wire:model.live.debounce.250ms="searchName" />
                        </div>
                        <div class="col-span-9 sm:col-span-2">
                            <x-label for="searchTelefono" value="{{ __('Teléfono') }}" />
                            <x-input id="searchTelefono" type="text" class="mt-1 block w-full"
                                wire:model.live.debounce.250ms="searchTelefono" />
                        </div>
                        <div class="col-span-9 sm:col-span-4">
                            <x-label for="searchEmail" value="{{ __('Email') }}" />
                            <x-input id="searchEmail" type="text" class="mt-1 block w-full"
                                wire:model.live.debounce.250ms="searchEmail" />
                        </div>
                    </div>
                    @if ($user != null && $user != 'busqueda_sin_iniciar')
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                        ###
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                        Nombre y apellido
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                        Teléfono
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                        Email
                                    </th> 
                                    <th>
                                    </th>                                   
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tr>
                                <td class="px-1 py-2 whitespace-nowrap">
                                    {{ $user->id }}
                                </td>
                                <td class="px-1 py-2 whitespace-wrap">
                                    {{ $user->name }}
                                </td>
                                <td class="px-1 py-2 whitespace-nowrap">
                                    {{ $user->telefono }}
                                </td>
                                <td class="px-1 py-2 whitespace-wrap">
                                    {{ $user->email }}
                                </td>  
                                <td class="px-1 py-2 whitespace-wrap">
                                    <x-button wire:click="selectUser({{ $user->id }})">Seleccionar</x-button>
                                </td>                            
                            </tr>
                        </table>
                        
                    @elseif($user == null)
                        <h2>{{ __('No se encontraron registros') }}</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
