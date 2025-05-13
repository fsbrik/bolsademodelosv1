<?php

namespace App\Livewire\Planes;

use Livewire\Component;
use App\Models\Pedido;

class PlanEdit extends Component
{
    public Pedido $plan;

    public function mount($planId)
    {
        $this->plan = Pedido::findOrFail($planId);

    }

    public function render()
    {
        return view('livewire.planes.plan-edit');
    }
}
