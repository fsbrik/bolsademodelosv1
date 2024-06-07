<?php

namespace App\Livewire\Admin;

use Livewire\Component;
//use App\Models\User;
use App\Models\Empresa;


class ShowUserEmpresa extends Component
{
 
    //public $user, $empresaId, $userId;
    public $name, $telefono, $email;

    public function mount($empresaId)
    {
        $empresa = Empresa::findOrFail($empresaId);
        $this->name = $empresa->user->name;
        $this->telefono = $empresa->user->telefono;
        $this->email = $empresa->user->email;       
    }

    public function render()
    {
        return view('livewire.admin.show-info-user-empresa');
    }
}
