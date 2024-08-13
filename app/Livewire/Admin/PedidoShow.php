<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Pedido;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PedidoShow extends Component
{
    public $pedido;
    public $servicios;
    public $perPage = 10;

    public function mount($pedidoId)
    {
        $user = Auth::user();

        /* if ($user->hasRole('admin')) {
            $this->pedido = Pedido::with(['user', 'servicios'])
                ->where('id', 'like', '%' . $this->searchTerm . '%')
                ->orWhereHas('user', function ($query) {
                    $query->where('name', 'like', '%' . $this->searchTerm . '%');
                })
                ->orWhereHas('servicios', function ($query) {
                    $query->where('cat_ser', 'like', '%' . $this->searchTerm . '%');
                });
        } elseif ($user->hasRole('empresa')) {
            $this->pedido = Pedido::with('user', 'servicios')->where('user_id', $user->id)
                ->whereHas('servicios', function ($query) {
                    $query->where('cat_ser', 'empresa')
                        ->where('sub_cat', 'reservas');
                });
        } elseif ($user->hasRole('modelo')) {
            $this->pedido = Pedido::with('user', 'servicios')->where('user_id', $user->id)
                ->whereHas('servicios', function ($query) {
                    $query->where('cat_ser', 'modelo');
                });
        } */

        $this->pedido = Pedido::with('servicios')->findOrFail($pedidoId);
        if($this->pedido->user->hasRole('empresa')){
            $this->pedido->servicios =  $this->pedido->servicios->filter(function($servicio) {
                return $servicio->sub_cat === 'reservas';
            });
            
        }

        $this->servicios = $this->pedido->servicios;
        $this->pedido->fecha = Carbon::parse($this->pedido->fecha);
    }

    public function destroy($pedidoId){
        $pedido = Pedido::findOrFail($pedidoId);
        $pedido->delete();
        session()->flash('message', 'se eliminó la reserva de '.$pedido->user->name);
        //$pedidos = Pedido::paginate($this->perPage);
        return redirect()->route('pedidos.index');
    }

    public function render()
    {
        return view('livewire.admin.pedido-show');
    }
}
