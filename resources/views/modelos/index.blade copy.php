<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modelos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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
                                <th scope="col"
                                    class="px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Sexo
                                </th>
                                <th scope="col"
                                    class="px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Zona de residencia
                                </th>
                                <th scope="col"
                                    class="px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado
                                </th>
                                <th scope="col"
                                    class="px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Habilita
                                </th>
                                <th scope="col"
                                    class="px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($modelos as $modelo)
                                <tr>
                                    <td class="px-1 py-2 whitespace-nowrap">
                                        {{ $modelo->mod_id }}
                                    </td>
                                    <td class="px-1 py-2 whitespace-wrap">
                                        {{ $modelo->user->name }}
                                    </td>
                                    <td class="px-1 py-2 whitespace-nowrap">
                                        {{ $modelo->user->telefono }}
                                    </td>
                                    <td class="px-1 py-2 whitespace-wrap">
                                        {{ $modelo->user->email }}
                                    </td>
                                    <td class="px-1 py-2 whitespace-wrap">
                                        {{ $modelo->sexo }}
                                    </td>
                                    <td class="px-1 py-2 whitespace-wrap">
                                        {{ $modelo->zon_res }}
                                    </td>
                                    <td class="px-1 py-2 whitespace-wrap">
                                        {{ $modelo->estado }}
                                    </td>
                                    <td class="px-1 py-2 whitespace-wrap">
                                        {{ $modelo->habilita }}
                                    </td>
                                    <td class="px-1 py-2 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('modelos.show', $modelo->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('modelos.edit', $modelo->id) }}"
                                            class="text-yellow-600 hover:text-yellow-900" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('modelos.destroy', $modelo->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900"
                                                title="Borrar"
                                                onclick="return confirm('¿Estás seguro de que deseas eliminar esta modelo?');">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
