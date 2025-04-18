<?php

namespace App\Livewire;

use App\Livewire\Forms\EmpresaForm;
use Livewire\Component;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;

class EmpresaCreate extends Component
{
    //public $tipo = "A", $cuit, $rubro, $nom_com, $domicilio;

    public EmpresaForm $empresa;

    public function mount()
    {
        $this->empresa->tipo = 'A';
        $this->empresa->user_id = Auth::user()->id;
    }

    public function store()
    {

        $this->empresa->validate();
        Empresa::create($this->empresa->all());

        return redirect()->route('empresas.index')->with('message', '¡Empresa creada con éxito!');
    }

    public function render()
    {
        return view('livewire.empresa-create');
    }
}
