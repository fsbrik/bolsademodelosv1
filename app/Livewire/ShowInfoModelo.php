<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Modelo;
use Livewire\Attributes\On;


class ShowInfoModelo extends Component
{
    public $modelo, $localidades;

    public function mount($modeloId)
    {
        $this->localidades = include(public_path('storage/localidades/localidades.php'));
        $modelo = modelo::findOrFail($modeloId);
        $this->modelo = $modelo->toArray();   
    }

    public function render()
    {
        return view('livewire.show-info-modelo');
    }
}
