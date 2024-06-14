<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empresa;

class EmpresaEdit extends Component
{
    public $empresa, $empresaId;

    public function mount($empresaId)
    {
        $empresa = Empresa::findOrFail($empresaId);
        $this->empresa = $empresa->toArray();
        $this->empresaId = $empresaId;
        /* $this->nom_com = $empresa->nom_com;
        $this->domicilio = $empresa->domicilio;
        $this->rubro = $empresa->rubro; */
    }

    public function updateEmpresa()
    {
        $this->validate([
            'empresa.nom_com' => ['required', 'string', 'max:255'],
            'empresa.domicilio' => ['required', 'string', 'max:255'],
            'empresa.rubro' => ['required', 'string', 'max:255'],

            // Agrega más reglas de validación según sea necesario
        ]);

        $empresa = Empresa::findOrFail($this->empresaId);
        $empresa->update($this->empresa);
        /* $empresa->update([
            'nom_com' => $this->empresa->nom_com,
            'domicilio' => $this->domicilio,
            'rubro' => $this->rubro,
        ]); */
        session()->flash('message', '¡Empresa actualizada con éxito!');
        return redirect()->route('empresas.show', $this->empresaId);
        // Restablecer el estado del componente para recargar la página
        //$this->reset();
    }

    public function render()
    {
        return view('livewire.empresa-edit');
    }
}
