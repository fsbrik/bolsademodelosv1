<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empresa;


class ShowInfoEmpresa extends Component
{
 
    public $empresa;
    //public $name, $telefono, $email;

    public function mount($empresaId)
    {
        $empresa = Empresa::findOrFail($empresaId);
        $this->empresa = $empresa->toArray();
        //$this->telefono = $empresa->user->telefono;
        //$this->email = $empresa->user->email;       
    }

    public function render()
    {
        return view('livewire.show-info-empresa');
    }
}
