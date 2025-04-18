<?php

namespace App\Livewire;

use App\Livewire\Forms\EmpresaForm;
use Livewire\Component;
use App\Models\Empresa;

class EmpresaEdit extends Component
{
    public EmpresaForm $empresa;
    public Empresa $empresaOriginal;

    

    public function mount($empresaId)
    {
        $this->empresaOriginal = Empresa::findOrFail($empresaId);       
        $this->empresa->fill($this->empresaOriginal->toArray()); // Cargar los valores del modelo en el Form Object
        
    }

    public function updateEmpresa()
    {
        $this->empresa->validate();
        $this->empresaOriginal->update($this->empresa->all());
        
        return redirect()->route('empresas.show', $this->empresaOriginal->id)->with('message', '¡'.$this->empresaOriginal->user->name.' actualizaste tu empresa con éxito!');

    }

    public function render()
    {
        return view('livewire.empresa-edit');
    }
}
