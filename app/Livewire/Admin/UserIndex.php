<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

/* class UserIndex extends Component
{
    use WithPagination;

    public $searchName = '';
    public $searchEmail = '';

    protected $updatesQueryString = [
        'searchName' => ['except' => ''],
        'searchEmail' => ['except' => ''],
    ];

    public function updatingSearchName()
    {
        $this->resetPage();
    }

    public function updatingSearchEmail()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::where('name', 'LIKE', '%'.$this->searchName.'%')
                     ->orWhere('email', 'LIKE', '%'.$this->searchEmail.'%')
                     ->paginate(10);

        return view('livewire.admin.user-index', compact('users'));
    }
} */

class UserIndex extends Component
{
    public $searchName, $searchTelefono, $searchEmail;

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
