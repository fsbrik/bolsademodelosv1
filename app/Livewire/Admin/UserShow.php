<?php

namespace App\Livewire\Admin;

use Livewire\Component;
//use App\Models\User;
use App\Models\User;


class UserShow extends Component
{
 
    public $user;

    public function mount($id)
    {
        $user = User::findOrFail($id);
        $this->user = $user->toArray();    
    }

    public function render()
    {
        return view('livewire.admin.user-show');
    }
}
