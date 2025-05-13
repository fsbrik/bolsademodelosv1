<?php

use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use App\Traits\Searching\HasSearching;
use App\Models\Empresa;
use App\Models\User;
use Livewire\Attributes\On;

new class extends Component {

    use WithPagination;
    use HasSearching; // trait para los campos de busqueda en la tabla


    public function queryUsers()
    {
        $users = User::query();

        if ($this->searchName) {
            $users->where('name', 'like', '%' . $this->searchName . '%');
        }

        if ($this->searchTelefono) {
            $users->where('telefono', 'like', '%' . $this->searchTelefono . '%');
        }

        if ($this->searchEmail) {
            $users->where('email', 'like', '%' . $this->searchEmail . '%');
        }

        // Obtenemos los IDs de los usuarios filtrados
        return $users->pluck('id');
    }

    public function queryEmpresas()
    {
        $empresas = Empresa::query();

        if ($this->searchComercial) {
            $empresas->where('nom_com', 'like', '%' . $this->searchComercial . '%');
        }

        if ($this->searchDomicilio) {
            $empresas->where('domicilio', 'like', '%' . $this->searchDomicilio . '%');
        }

        if ($this->searchCuit) {
            $empresas->where('cuit', 'like', '%' . $this->searchCuit . '%');
        }

        // Obtenemos los IDs de las empresas filtradas
        return $empresas->pluck('id');
    }

    public function destroy(Empresa $empresa)
    {
        $empresa->delete();
        $this->dispatch('mostrar-alerta', tipo: 'error', mensaje: 'Se eliminó a la empresa ' . $empresa->nom_com);
        $this->resetPage();
    }

    public function with(): array
    {
        $empresasIds = $this->queryEmpresas(); // filtro los Ids de las empresas en el search

        if (Auth::user()->hasRole('admin')) 
        {
            $userIds = $this->queryUsers();  // filtro los Ids de los users en el search

            // Ahora buscamos las empresas que coincidan con ambos criterios de búsqueda
            $empresas = Empresa::whereIn('user_id', $userIds)->with('user')->whereIn('id', $empresasIds)->paginate(10);

        } 
        elseif (Auth::user()->hasRole('empresa')) 
        {
            $empresas = Empresa::where('user_id', Auth::id())->whereIn('id', $empresasIds)->paginate(10);
        }

        return [
            'empresas' => $empresas,
        ];
    }
}; ?>

<div class="border-base-content/25 w-full overflow-x-auto ">
    @if ($empresas->count())
        <table>
            <thead>
                <tr>
                    <x-table.headers :columns="[
                        ...auth()->user()->hasRole('admin') ? ['Contacto', 'Teléfono', 'Email'] : [],
                        'Nombre Comercial',
                        'Domicilio',
                        'Tipo',
                        'CUIT',
                    ]" />
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
                                <x-cards.button-icon-show route="empresas.show" :param="$empresa->id" />
                                <x-cards.button-icon-edit route="empresas.edit" :param="$empresa->id" />
                                <x-cards.button-icon-delete :param="$empresa->id" tipo="a la empresa {{ $empresa->nom_com }}" />
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $empresas->links() }}
    @else
        <h2>{{ __('Creá la ficha de tu empresa y empezá a contratar nuestros servicios!') }}</h2>
    @endif

    @can('empresas.create')
        <div class="buttons-container">
            <x-cards.button-create route="empresas.create">{{ __('Crear empresa') }} </x-cards.button-create>
        </div>
    @endcan
</div>
