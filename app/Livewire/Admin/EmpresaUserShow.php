<?php

namespace App\Livewire\Admin;

use Livewire\Component;
//use App\Models\User;
use App\Models\Empresa;


class EmpresaUserShow extends Component
{
 
    public $empresa;

    public function mount($empresaId)
    {
        $empresa = Empresa::findOrFail($empresaId);
        $this->empresa = $empresa->user->toArray();
    }

    public function render()
    {
        return view('livewire.admin.empresa-user-show');
    }
}
