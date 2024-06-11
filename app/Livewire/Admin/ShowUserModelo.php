<?php

namespace App\Livewire\Admin;

use Livewire\Component;
//use App\Models\User;
use App\Models\Modelo;


class ShowUsermodelo extends Component
{
 
    public $name, $telefono, $email;

    public function mount($modeloId)
    {
        $modelo = modelo::findOrFail($modeloId);
        $this->name = $modelo->user->name;
        $this->telefono = $modelo->user->telefono;
        $this->email = $modelo->user->email;       
    }

    public function render()
    {
        return view('livewire.admin.show-info-user-modelo');
    }
}
