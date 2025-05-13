<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\On;

class UserShow extends Component
{
 
    public $user;

    public function mount($userId)
    {
        $this->user = User::findOrFail($userId);
    }

    /* #[On('success')]
    public function success($successMessage)
    {
        session()->flash('successMessage', $successMessage);
    }

    #[On('error')]
    public function error($errorMessage)
    {
        session()->flash('errorMessage', $errorMessage);
    }    */ 

    public function render()
    {
        return view('livewire.users.user-show');
    }
}
