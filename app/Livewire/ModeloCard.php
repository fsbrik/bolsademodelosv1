<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Modelo;
use Livewire\WithPagination;

class ModeloCard extends Component
{
    use WithPagination;

    public function render()
    {
        $modelos = Modelo::with('user')->paginate(10); // Ajusta el número de elementos por página según lo necesites
        return view('livewire.modelo-card', ['modelos' => $modelos]);
    }
}
