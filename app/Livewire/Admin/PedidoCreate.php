<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Servicio;
use App\Models\User;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PedidoCreate extends Component
{
    public $cantidad = [];
    public $subtotals = [];
    public $total;
    public $servicios;
    public $selectedUser = null;
    public $fecha;

    protected $listeners = ['userSelected' => 'updateUser'];
    protected $rules = [
        'selectedUser' => 'required',
        'cantidad.*' => 'integer|gte:0',
    ];
    protected $messages = [
        'selectedUser.required' => 'Debe seleccionarse un usuario',
        'cantidad.*.integer' => 'Ingresar un número entero',
        'cantidad.*.gte' => 'El número debe ser igual o mayor a 0',
    ];

    public function mount(){
        $servicios = Servicio::where('hab_ser',1)->where('sub_cat', '<>', 'contrataciones')->get();
        $this->servicios = $servicios;
        $this->cantidad = array_fill(0, $this->servicios->count(), 0);
        $this->calculateSubtotals();
        $this->fecha = Carbon::now()->format('Y-m-d');
        if(!Auth::user()->hasRole('admin')){
            $user = Auth::user();
            $this->updateUser($user);
        }
    }

    public function updateUser(User $user)
    {
        // obtener el rol del usuario
        $userRole = $user->roles->first()->name;

        // obtener la subcategoria 'reservas' evitando las 'contrataciones' para el caso de las empresas
        if($userRole == 'empresa'){
            $this->servicios = Servicio::where('hab_ser',1)->where('cat_ser', $userRole)
                               ->where('sub_cat', 'reservas')->get();
        } 
        elseif($userRole == 'modelo'){
            $this->servicios = Servicio::where('hab_ser',1)->where('cat_ser', $userRole)->get();
        }

        $this->cantidad = array_fill(0, $this->servicios->count(), 0);
        $this->calculateSubtotals();
        $this->calculateTotal();
        $this->selectedUser = $user;
    }

    public function updatedCantidad($value, $index)
    {
        $this->validate();

        if ($value === '') {
            $value = 0;
        }
        
        $this->cantidad[$index] = $value;
        $this->subtotals[$this->servicios[$index]->id] = $this->servicios[$index]->precio * $value;
        $this->calculateTotal();
    } 
   
    public function calculateSubtotals()
    {
        foreach ($this->servicios as $index => $servicio) {
            /* if($servicio->precio == null){
                $servicio->precio = 0;
            } */
            $this->subtotals[$servicio->id] = $servicio->precio * $this->cantidad[$index];
        }
    }

    public function calculateTotal(){
        $this->total = array_sum($this->subtotals);
    }

    public function submit()
    {
        $this->validate();

        $totalCantidades = array_sum($this->cantidad);

        if ($totalCantidades <= 0) {
            session()->flash('error', 'Debe seleccionar al menos un servicio con una cantidad mayor que 0.');
            return;
        }

        DB::transaction(function () {
            $pedido = Pedido::create([
                'user_id' => $this->selectedUser['id'],
                'fecha' => $this->fecha,
                'total' => array_sum($this->subtotals),
            ]);

            foreach ($this->cantidad as $index => $cantidad) {
               // if ($cantidad > 0) {
                    $servicio = $this->servicios[$index];
                    $pedido->servicios()->attach($servicio->id, [
                        'cantidad' => $cantidad,
                    ]);
               // }
            }
        });

        session()->flash('message', 'Reserva de '.$this->selectedUser->name.' creada con éxito.');

        return redirect()->route('pedidos.index');
    }

    public function render()
    {
        return view('livewire.admin.pedido-create', ['user' => $this->selectedUser]);
    }
}
