<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Livewire\Forms\UserForm;
use App\Models\User;

class UserEdit extends Component
{
    public User $userOriginal;
    public UserForm $user;
    public $userId;

    public function mount($userId)
    {
        $this->userOriginal = User::findOrFail($userId);
        $this->user->fill($this->userOriginal->toArray());
        $this->userId = $userId;
    }

    /* public function updateUser()
    {
        $this->dispatch('updateUser');
    } */
        
    public function render()
    {
        return view('livewire.users.user-edit');
    }
}
