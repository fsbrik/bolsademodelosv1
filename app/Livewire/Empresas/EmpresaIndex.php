<?php

namespace App\Livewire\Empresas;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Empresa;
use Livewire\Attributes\On;

class EmpresaIndex extends Component
{
    

    public function render()
    {
 
        return view('livewire.empresas.empresa-index');
    }
}
