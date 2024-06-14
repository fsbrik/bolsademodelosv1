<?php

namespace App\Livewire\Admin;

use Livewire\Component;
//use App\Models\User;
use App\Models\Modelo;


class ModeloUserShow extends Component
{
 
    public $modelo;

    public function mount($modeloId)
    {
        $modelo = Modelo::findOrFail($modeloId);
        $this->modelo = $modelo->user->toArray();  
    }

    public function render()
    {
        return view('livewire.admin.modelo-user-show');
    }
}
