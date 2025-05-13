<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Traits\Searching\HasSearching;
use App\Models\User;
use Livewire\Attributes\On;

new class extends Component {

    use WithPagination;
    use HasSearching;

    public function destroy(User $user)
    {
        $user->delete();
        $this->dispatch('error', errorMessage: 'Se eliminó al usuario ' . $user->name);
    }

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

        return $users->paginate(10);
    }

    public function with(): array
    {

        return [
            'users' => $this->queryUsers(),
        ];
    }
}; ?>

<x-container>
    @if ($users->count())
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <x-table.headers :columns="['ID', 'Nombre y apellido', 'Teléfono', 'Email', 'Acciones']" />
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($users as $user)
                    <tr>
                        <td>
                            {{ $user->id }}
                        </td>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->telefono }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            <x-cards.button-icon-show route="users.show" :param="$user->id" />
                            <x-cards.button-icon-edit route="users.edit" :param="$user->id" />
                            <x-cards.button-icon-delete :param="$user->id" tipo="al usuario {{ $user->name }}" />
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
</x-container>
