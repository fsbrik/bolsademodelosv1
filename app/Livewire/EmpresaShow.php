<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empresa;


class EmpresaShow extends Component
{
 
    public $empresa;

    public function mount($empresaId)
    {
        $empresa = Empresa::findOrFail($empresaId);
        $this->empresa = $empresa->toArray();    
    }

    public function render()
    {
        return view('livewire.empresa-show');
    }
}
