<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Pedido;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Livewire\WithPagination;

class HabilitarPlanes extends Component
{
    use WithPagination;

    public $searchTerm;
    public $sort_by = null;
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $nombreBoton;

    public function updating($field)
    {
        if (in_array($field, [
            'searchTerm'
        ])) {
            $this->resetPage();
        }
    }

    public function habilitarPlan(Pedido $pedido)
    {   
        $planSeleccionado = $pedido->servicios()->where('pedido_id', $pedido->id)->first()->nom_ser;
        
        switch ($planSeleccionado)
        {
            case 'plan simple':
                $fec_fin = null;
                break;
            case 'plan mensual':
                $fec_fin = Carbon::now()->addDays(30)->format('Y-m-d');
                break;
            case 'plan anual':
                $fec_fin = Carbon::now()->addDays(365)->format('Y-m-d');
                break;
        }

        if($pedido->habilita === null || $pedido->habilita == 0)
        {
            $pedido->update([
                'habilita' => 1,
                'fec_ini' => Carbon::now()->format('Y-m-d'),
                'fec_fin' => $fec_fin]);
        } 
        else
        {
            $pedido->update([
                'habilita' => 0,
                'fec_ini' => null,
                'fec_fin' => null]);
        }
    }

    public function destroy(Pedido $pedido){
        $pedido->delete();
        session()->flash('message', 'se eliminó el plan de '.$pedido->user->name);
        //$pedidos = Pedido::paginate($this->perPage);
        //return view('livewire.admin.habilitar-planes', compact('pedidos'));
    }

    public function sortBy($field)
    {
        if ($this->sort_by === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort_by = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {

        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $pedidos = Pedido::with(['user', 'servicios'])
            ->whereHas('servicios', function ($query) {
                $query->where('sub_cat', 'planes');
            })
            ->where(function ($query) {
                $query->where('id', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('user', function ($query) {
                        $query->where('name', 'like', '%' . $this->searchTerm . '%');
                    })
                    ->orWhereHas('user', function ($query) {
                        $query->where('telefono', 'like', '%' . $this->searchTerm . '%');
                    });
            });

        }
        

        if ($this->sort_by) {
            $pedidos->orderBy($this->sort_by, $this->sortDirection);
        }
        /* else {
            $pedidos->orderBy('fec_ini', 'desc');
        } */

        $pedidos = $pedidos->paginate($this->perPage);

        
    
        return view('livewire.admin.habilitar-planes', compact('pedidos'));
    }
}
