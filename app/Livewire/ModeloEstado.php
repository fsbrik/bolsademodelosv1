<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Modelo;
use Illuminate\Support\Facades\Auth;

class ModeloEstado extends Component
{
    //public $modeloId;
    public $estado, $modelo;

    public function mount()
    {
        $modeloId = Auth::user()->modelo->id;
        $this->modelo = Modelo::findOrFail($modeloId);
        //$this->modeloId = $modelo->id;
        $this->estado = $this->modelo->estado;
    }

    public function cambiarEstado()
    {
        //$modelo = Modelo::findOrFail($this->modeloId);
        $this->estado = !$this->estado; // Cambia el estado al opuesto
        $this->modelo->estado = $this->estado;
        $this->modelo->save();

        session()->flash('message', 'Estado actualizado con éxito.');
    }

    public function getEstadoDisplayProperty()
    {
        return $this->estado == 1 ? 'Activo' : 'Inactivo';
    }

    public function render()
    {
        return view('livewire.modelo-estado');
    }
}
