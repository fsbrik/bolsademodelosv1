<?php

namespace App\Livewire\Admin;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Carbon;

class PedidoUserSearch extends Component
{
    public $searchName, $searchTelefono, $searchEmail;

    public function selectUser($userId)
    {
        $user = User::find($userId);
        $this->dispatch('userSelected', user: $user);
    }

    public function render()
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

        if (!$this->searchName && !$this->searchTelefono && !$this->searchEmail){
            $user = 'busqueda_sin_iniciar';
        } else {
            $user = $users->first();
        }

        return view('livewire.admin.pedido-user-search', compact('user'));
    }
}
