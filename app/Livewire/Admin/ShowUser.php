<?php

namespace App\Livewire\Admin;

use Livewire\Component;
//use App\Models\User;
use App\Models\User;


class ShowUser extends Component
{
 
    public $user;

    public function mount($id)
    {
        $user = User::findOrFail($id);
        $this->user = $user->toArray();    
    }

    public function render()
    {
        return view('livewire.admin.show-user');
    }
}
