<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserIndex extends Component
{
    public $searchName, $searchTelefono, $searchEmail;

    use WithPagination;

    public function updatingSearchName()
    {
        $this->resetPage();
    }

    public function updatingSearchTelefono()
    {
        $this->resetPage();
    }

    public function updatingSearchEmail()
    {
        $this->resetPage();
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

        $users = $users->paginate(10);

        return view('livewire.admin.user-index', compact('users'));
    }
}
