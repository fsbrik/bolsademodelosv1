<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Modelo;
use Livewire\WithPagination;

class ModeloCard extends Component
{
    public $modelos;

    use WithPagination;

    public function mount()
    {
        $this->modelos = Modelo::all();
    }

    public function render()
    {
        return view('livewire.modelo-card');
    }
}
