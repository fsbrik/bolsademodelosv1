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
            'empresa.tipo' => 'required|in:A,C', // Asumiendo que solo se permiten 'M' y 'F'
            'empresa.cuit' => ['required', 'regex:/^\d{2}-\d{8}-\d{1}$/'],
        ], [
            'empresa.nom_com.required' => 'El nombre comercial es obligatorio.',
            'empresa.nom_com.string' => 'El nombre comercial debe ser una cadena de texto.',
            'empresa.nom_com.max' => 'El nombre comercial no puede tener más de 255 caracteres.',
            'empresa.domicilio.required' => 'El domicilio es obligatorio.',
            'empresa.domicilio.string' => 'El domicilio debe ser una cadena de texto.',
            'empresa.domicilio.max' => 'El domicilio no puede tener más de 255 caracteres.',
            'empresa.rubro.required' => 'El rubro es obligatorio.',
            'empresa.rubro.string' => 'El rubro debe ser una cadena de texto.',
            'empresa.rubro.max' => 'El rubro no puede tener más de 255 caracteres.',
            'empresa.tipo.required' => 'El tipo es obligatorio.',
            'empresa.tipo.in' => 'El tipo debe ser A o C.',
            'empresa.cuit.required' => 'El CUIT es obligatorio.',
            'empresa.cuit.regex' => 'El CUIT debe tener el formato XX-XXXXXXXX-X.',
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
