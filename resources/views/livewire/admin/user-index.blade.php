<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-2/3 mx-auto bg-gray-100 grid grid-cols-9 gap-2 mb-4 p-4">
                        <div class="col-span-9 sm:col-span-3">
                            <x-label for="searchName" value="{{ __('Nombre / apellido') }}" />
                            <x-input id="searchName" type="text" class="mt-1 block w-full"
                                wire:model.live.debounce.250ms="searchName" />
                        </div>
                        <div class="col-span-9 sm:col-span-3">
                            <x-label for="searchTelefono" value="{{ __('Teléfono') }}" />
                            <x-input id="searchTelefono" type="text" class="mt-1 block w-full"
                                wire:model.live.debounce.250ms="searchTelefono" />
                        </div>
                        <div class="col-span-9 sm:col-span-3">
                            <x-label for="searchEmail" value="{{ __('Email') }}" />
                            <x-input id="searchEmail" type="text" class="mt-1 block w-full"
                                wire:model.live.debounce.250ms="searchEmail" />
                        </div>
                    </div>
                    @if ($users->count())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ###
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre y apellido
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Teléfono
                                    </th>
                                    <th scope="col"
                                        class="px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $user)
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
                                        <td class="px-1 py-2 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('users.show', $user->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('users.edit', $user->id) }}"
                                                class="text-yellow-600 hover:text-yellow-900" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900"
                                                    title="Borrar"
                                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-8">
                            {{ $users->links() }}
                        </div>
                    @else
                        <h2>{{ __('No se encontraron registros') }}</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
