<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;

class EmpresaCreate extends Component
{
    public $tipo = "A", $cuit, $rubro, $nom_com, $domicilio;

    public function store(){
        $this->validate([
            'nom_com' => ['required', 'string', 'max:255'],
            'domicilio' => ['required', 'string', 'max:255'],
            'rubro' => ['required', 'string', 'max:255'],
            'tipo' => 'required|in:A,C', // Asumiendo que solo se permiten 'M' y 'F'
            'cuit' => ['required', 'regex:/^\d{2}-\d{8}-\d{1}$/'],
        ], [
            'nom_com.required' => 'El nombre comercial es obligatorio.',
            'nom_com.string' => 'El nombre comercial debe ser una cadena de texto.',
            'nom_com.max' => 'El nombre comercial no puede tener más de 255 caracteres.',
            'domicilio.required' => 'El domicilio es obligatorio.',
            'domicilio.string' => 'El domicilio debe ser una cadena de texto.',
            'domicilio.max' => 'El domicilio no puede tener más de 255 caracteres.',
            'rubro.required' => 'El rubro es obligatorio.',
            'rubro.string' => 'El rubro debe ser una cadena de texto.',
            'rubro.max' => 'El rubro no puede tener más de 255 caracteres.',
            'tipo.required' => 'El tipo es obligatorio.',
            'tipo.in' => 'El tipo debe ser A o C.',
            'cuit.required' => 'El CUIT es obligatorio.',
            'cuit.regex' => 'El CUIT debe tener el formato XX-XXXXXXXX-X.',
        ]);

        Empresa::create([
            'tipo' => $this->tipo,
            'cuit' => $this->cuit,
            'rubro' => $this->rubro,
            'nom_com' => $this->nom_com,
            'domicilio' => $this->domicilio,
            'user_id' => Auth::user()->id
        ]);

        session()->flash('message', '¡Empresa creada con éxito!');
        return redirect()->route('empresas.index');

    }

    public function render()
    {
        return view('livewire.empresa-create');
    }
}
