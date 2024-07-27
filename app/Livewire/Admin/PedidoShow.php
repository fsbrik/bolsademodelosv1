<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Pedido;
use Carbon\Carbon;

class PedidoShow extends Component
{
    public $pedido;
    public $servicios;

    public function mount($pedidoId)
    {
        $this->pedido = Pedido::with('servicios')->findOrFail($pedidoId);
        $this->servicios = $this->pedido->servicios;
        $this->pedido->fecha = Carbon::parse($this->pedido->fecha);
    }

    public function render()
    {
        return view('livewire.admin.pedido-show');
    }
}