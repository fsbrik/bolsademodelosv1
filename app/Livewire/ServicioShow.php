<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Servicio;

class ServicioShow extends Component
{
    public $servicio;

    public function mount($servicioId)
    {
        $servicio = Servicio::findOrFail($servicioId);
        $servicio = $servicio->toArray();
        $this->servicio = $servicio;
    }

    public function getHabilitaDisplayProperty()
    {
        return $this->servicio['hab_ser'] == 1 ? 'sí' : 'no';
    }

    public function render()
    {
        return view('livewire.servicio-show');
    }
}
