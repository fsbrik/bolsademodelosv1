<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Modelo;
use Livewire\WithPagination;

class EmpresaContratacion extends Component
{
    use WithPagination;

    public function render()
    {
        $modelos = Modelo::paginate(10);
        return view('livewire.empresa-contratacion', compact('modelos'));
    }
}
