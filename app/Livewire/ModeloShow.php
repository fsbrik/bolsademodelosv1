<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Modelo;
use Livewire\Attributes\On;


class ModeloShow extends Component
{
    public $modelo, $localidades;

    public function mount($modeloId)
    {
        $this->localidades = include(public_path('storage/localidades/localidades.php'));
        $modelo = Modelo::findOrFail($modeloId);    
        $this->modelo = $modelo->toArray();   
    }

    public function getDisviaDisplayProperty()
    {
        return $this->modelo['dis_via'] == 1 ? 'sí' : 'no';
    }

    public function getTitmodDisplayProperty()
    {
        return $this->modelo['tit_mod'] == 1 ? 'sí' : 'no';
    }

    public function getEstadoDisplayProperty()
    {
        return $this->modelo['estado'] == 1 ? 'activo' : 'inactivo';
    }

    public function getHabilitaDisplayProperty()
    {
        return $this->modelo['habilita'] == 1 ? 'sí' : 'no';
    }

    public function render()
    {
        return view('livewire.modelo-show');
    }
}
