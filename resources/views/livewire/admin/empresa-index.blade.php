<div>
    <x-slot name="header">        
        <x-header bold='true'>
            {{ __('Lista de Empresas') }}
        </x-header>
    </x-slot>

        <x-container>
                    @if (Auth::user()->hasRole('admin'))
                        <x-search-user></x-search-user>
                        <x-search-empresa></x-search-empresa>
                    @endif

                    @if (session()->has('message'))
                        <x-alert-success> {{ session('message') }} </x-alert-success>
                    @endif

                    @if ($empresas->count())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    @if (Auth::user()->hasRole('admin'))
                                        <th scope="col"
                                            class="px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Contacto
                                        </th>
                                        <th scope="col"
                                            class="px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Teléfono
                                        </th>
                                        <th scope="col"
                                            class="px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                    @endif
                                    <th scope="col"
                                        class="px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre Comercial
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Domicilio
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tipo
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cuit
                                    </th>
                                    @can('empresas.index')
                                        <th scope="col"
                                            class="px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($empresas as $empresa)
                                    <tr>
                                        @if (Auth::user()->hasRole('admin'))
                                            <td class="px-1 py-2 whitespace-nowrap">
                                                {{ $empresa->user->name }}
                                            </td>
                                            <td class="px-1 py-2 whitespace-nowrap">
                                                {{ $empresa->user->telefono }}
                                            </td>
                                            <td class="px-1 py-2 break-all">
                                                {{ $empresa->user->email }}
                                            </td>
                                        @endif
                                        <td class="px-1 py-2 whitespace-wrap">
                                            {{ $empresa->nom_com }}
                                        </td>
                                        <td class="px-1 py-2 whitespace-wrap">
                                            {{ $empresa->domicilio }}
                                        </td>
                                        <td class="px-1 py-2 whitespace-wrap">
                                            {{ $empresa->tipo }}
                                        </td>
                                        <td class="px-1 py-2 whitespace-wrap">
                                            {{ $empresa->cuit }}
                                        </td>
                                        @can('empresas.index')
                                            <td class="px-1 py-2 whitespace-nowrap text-sm font-medium">
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



        </x-container>
</div>
