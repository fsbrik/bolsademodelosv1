<?php

namespace App\Livewire\Empresas;

use Livewire\Component;
use App\Models\Empresa;
use Livewire\Attributes\On;

class EmpresaEdit extends Component
{
    public Empresa $empresa;

    public function mount($empresaId)
    {
        $this->empresa = Empresa::findOrFail($empresaId);

    }

    public function render()
    {
        return view('livewire.empresas.empresa-edit');
    }
}
