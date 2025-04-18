<?php

use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use App\Models\Empresa;
use Livewire\Attributes\On;

new class extends Component {
    use WithPagination;

    #[On('empresa-eliminada')]
    public function resetear() {
        $this->resetPage();
    }

    public function with(): array {
    return [
        'empresas' => Empresa::with('user')
                ->where('user_id', Auth::id())
                ->paginate(10)
    ];
        
    }

}?>

<div class="border-base-content/25 w-full overflow-x-auto ">
    <table>
        <thead>
            <tr>
                <x-table.headers :columns="[...(auth()->user()->hasRole('admin') ? ['Contacto', 'Teléfono', 'Email'] : []),
                                            'Nombre Comercial', 'Domicilio', 'Tipo', 'CUIT']" />
                @can('empresas.index')
                    <th>Acciones</th>
                @endcan
            </tr>
        </thead>

        <tbody>
            @foreach ($empresas as $empresa)
                <tr>
                    @if (Auth::user()->hasRole('admin'))
                        <td>{{ $empresa->user->name }}</td>
                        <td>{{ $empresa->user->telefono }}</td>
                        <td>{{ $empresa->user->email }}</td>
                    @endif
                    <td>{{ $empresa->nom_com }}</td>
                    <td>{{ $empresa->domicilio }}</td>
                    <td>{{ $empresa->tipo }}</td>
                    <td>{{ $empresa->cuit }}</td>
                    @can('empresas.index')
                        <td>
                            <a href="{{ route('empresas.show', $empresa->id) }}" title="Ver">
                                <i class="fas fa-eye text-indigo-600 hover:text-indigo-900"></i>
                            </a>
                            <a href="{{ route('empresas.edit', $empresa->id) }}" title="Editar">
                                <i class="fas fa-edit text-yellow-600 hover:text-yellow-900"></i>
                            </a>
                            <button wire:click="$dispatch('eliminar-empresa', { empresa: {{ $empresa->id }} })"
                                onclick="return confirm('¿Estás seguro de eliminar esta empresa?')">
                                <i class="fas fa-trash-alt text-red-600 hover:text-red-900"></i>
                            </button>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $empresas->links() }}
</div>
