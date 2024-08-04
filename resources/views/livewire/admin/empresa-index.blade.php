<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Empresas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (Auth::user()->hasRole('admin'))
                        <div class="w-2/3 mx-auto bg-gray-100 grid grid-cols-9 gap-2 pt-4 px-4">
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="searchName" value="{{ __('Nombre / apellido') }}" />
                                <x-input id="searchName" type="text" class="mt-1 block w-full"
                                    wire:model.live.debounce.250ms="searchName" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="searchTelefono" value="{{ __('Teléfono') }}" />
                                <x-input id="searchTelefono" type="text" class="mt-1 block w-full"
                                    wire:model.live.debounce.250ms="searchTelefono" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="searchEmail" value="{{ __('Email') }}" />
                                <x-input id="searchEmail" type="text" class="mt-1 block w-full"
                                    wire:model.live.debounce.250ms="searchEmail" />
                            </div>
                        </div>
                        <div class="w-2/3 mx-auto bg-gray-100 grid grid-cols-6 gap-2 mb-4 p-4">
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="searchComercial" value="{{ __('Nombre comercial') }}" />
                                <x-input id="searchComercial" type="text" class="mt-1 block w-full"
                                    wire:model.live.debounce.250ms="searchComercial" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="searchCuit" value="{{ __('Cuit') }}" />
                                <x-input id="searchCuit" type="text" class="mt-1 block w-full"
                                    wire:model.live.debounce.250ms="searchCuit" />
                            </div>
                        </div>
                    @endif
                    @if ($empresas->count())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    @if (Auth::user()->hasRole('admin'))
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Contacto
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Teléfono
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                    @endif
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre Comercial
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Domicilio
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tipo
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cuit
                                    </th>
                                    @can('empresas.index')
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($empresas as $empresa)
                                    <tr>
                                        @if (Auth::user()->hasRole('admin'))
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $empresa->user->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $empresa->user->telefono }}
                                            </td>
                                            <td class="px-6 py-4 break-all">
                                                {{ $empresa->user->email }}
                                            </td>
                                        @endif
                                        <td class="px-6 py-4 whitespace-wrap">
                                            {{ $empresa->nom_com }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-wrap">
                                            {{ $empresa->domicilio }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-wrap">
                                            {{ $empresa->tipo }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-wrap">
                                            {{ $empresa->cuit }}
                                        </td>
                                        @can('empresas.index')
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('empresas.show', $empresa->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-900" title="Ver">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('empresas.edit', $empresa->id) }}"
                                                    class="text-yellow-600 hover:text-yellow-900" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button wire:click="destroy({{ $empresa->id }})"
                                                    class="text-red-600 hover:text-red-900" title="Borrar"
                                                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta empresa?');">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $empresas->links() }}
                        @can('empresas.create')
                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4">
                                    <a wire:navigate href="{{ route('empresas.create') }}">
                                        {{ __('Crear otra empresa') }}
                                    </a>
                                </x-button>
                            </div>
                        @endcan
                    @else
                        <!-- En caso que todavía no haya ninguna empresa creada -->
                        <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
                            <div class="p-4">
                                <h2 class="text-xl font-semibold text-gray-800">Creá la ficha de tu empresa y empezá a
                                    contratar nuestros servicios!</h2>
                                @can('empresas.create')
                                    <div class="flex items-center justify-center mt-4">
                                        <x-button class="ml-4">
                                            <a wire:navigate href="{{ route('empresas.create') }}">
                                                {{ __('Crear empresa') }}
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
