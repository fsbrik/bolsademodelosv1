<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Pedido;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PedidoEdit extends Component
{
    public $pedidoId;
    public $pedido;
    public $cantidad = [];
    public $subtotals = [];
    public $total;
    public $servicios;
    public $selectedUser = null;
    public $fec_ini;

    protected $listeners = ['userSelected' => 'updateUser'];

    protected $rules = [
        'cantidad.*' => 'integer|gte:0',
    ];
    protected $messages = [
        'cantidad.*.integer' => 'Ingresar un número entero',
        'cantidad.*.gte' => 'El número debe ser igual o mayor a 0',
    ];

    public function mount($pedidoId)
    {
        $this->pedidoId = $pedidoId;
        $pedido = Pedido::with('servicios')->findOrFail($pedidoId);
        $this->pedido = $pedido;
        $this->fec_ini = $pedido->fec_ini;

        if (!Auth::user()->hasRole('admin')) {
            $user = Auth::user();
            $this->updateUser($user);
        } else {
            $this->selectedUser = User::findOrFail($pedido->user_id);
        }

        if (Auth::user()->hasRole('empresa')){
            $this->servicios = Servicio::where('cat_ser', 'empresa')->where('sub_cat', 'reservas')->where('hab_ser', 1)->get();
        }
        elseif (Auth::user()->hasRole('modelo')){
            $this->servicios = Servicio::where('cat_ser', 'modelo')->where('hab_ser', 1)->get();
        }
        elseif (Auth::user()->hasRole('admin')){
            if($this->selectedUser->roles->first()->name == 'empresa'){
                $this->servicios = Servicio::where('cat_ser', 'empresa')->where('hab_ser', 1)->where('sub_cat', 'reservas')->get();
            } else {
                // selectedUser es del role modelo
                $this->servicios = Servicio::where('cat_ser', 'modelo')->where('hab_ser', 1)->get();
            }
        }

        foreach ($this->servicios as $servicio) {
            $cantidad = $pedido->servicios->firstWhere('id', $servicio->id)->pivot->cantidad ?? 0;
            $this->cantidad[$servicio->id] = $cantidad;
            $this->subtotals[$servicio->id] = $servicio->precio * $cantidad;
        }

        $this->calculateTotal();
    }

    public function updateUser(User $user)
    {
        $userRole = $user->roles->first()->name;
        $this->servicios = Servicio::where('hab_ser', 1)->where('cat_ser', $userRole)->get();
        $this->cantidad = array_fill_keys($this->servicios->pluck('id')->toArray(), 0);
        $this->calculateSubtotals();
        $this->calculateTotal();
        $this->selectedUser = $user;
    }

    public function updatedCantidad($value, $servicioId)
    {
        $this->validate();

        if ($value === '') {
            $value = 0;
        }
        $this->cantidad[$servicioId] = $value;
        $servicio = $this->servicios->firstWhere('id', $servicioId);
        $this->subtotals[$servicioId] = $servicio->precio * $value;
        $this->calculateTotal();
    }

    public function calculateSubtotals()
    {
        foreach ($this->servicios as $servicio) {
            $this->subtotals[$servicio->id] = $servicio->precio * $this->cantidad[$servicio->id];
        }
    }

    public function calculateTotal()
    {
        $this->total = array_sum($this->subtotals);
    }

    public function update()
    {
        $this->validate();

        $pedido = Pedido::findOrFail($this->pedidoId);
        $pedido->fec_ini = $this->fec_ini;
        $pedido->total = $this->total;
        $pedido->save();

        $pedido->servicios()->sync([]);
        foreach ($this->cantidad as $servicioId => $cantidad) {
            if ($cantidad >= 0) {
                $pedido->servicios()->attach($servicioId, [
                    'cantidad' => $cantidad,
                ]);
            }
        }

        session()->flash('message', 'Reserva actualizada con éxito.');
        return redirect()->route('pedidos.index');
    }

    public function render()
    {
        return view('livewire.admin.pedido-edit', [
            'servicios' => $this->servicios,
        ]);
    }
}
