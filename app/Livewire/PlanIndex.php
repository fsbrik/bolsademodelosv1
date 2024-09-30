<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class PlanIndex extends Component
{
    use WithPagination;

    public $searchTerm;
    public $sort_by = null;
    public $sortDirection = 'asc';
    public $perPage = 10;

    /* public function updating($field)
    {
        if (in_array($field, [
            'searchTerm'
        ])) {
            $this->resetPage();
        }
    } */
    // Muestra u oculta el icono de eliminar en el caso que haya un plan habilitado
    public function getHabilita(Pedido $plan)
    {
        return $plan->habilita == 1 ? false : true;
    }

    public function destroy(Pedido $plan){
        $plan->delete();
        session()->flash('message', 'se eliminó el plan de '.$plan->user->name);
        /* $pedidos = Pedido::paginate($this->perPage);
        return view('livewire.plan-index', [
            'pedidos' => $pedidos,
        ]); */
    }

    /* public function sortBy($field)
    {
        if ($this->sort_by === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort_by = $field;
            $this->sortDirection = 'asc';
        }
    } */

    public function render()
    {
        $user = Auth::user();

        /* if ($user->hasRole('admin')) {
            $pedidos = Pedido::with(['user', 'servicios'])
            ->where('id', 'like', '%' . $this->searchTerm . '%')
            ->orWhereHas('user', function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orWhereHas('servicios', function ($query) {
                $query->where('cat_ser', 'like', '%' . $this->searchTerm . '%');
            });
        }
        elseif ($user->hasRole('empresa')) {
            $pedidos = Pedido::with('user', 'servicios')->where('user_id', $user->id)
            ->whereHas('servicios', function($query){
                $query->where('cat_ser', 'empresa')
                      ->where('sub_cat', 'reservas');
                    });
        }
        elseif ($user->hasRole('modelo')) {
            $pedidos = Pedido::with('user', 'servicios')->where('user_id', $user->id)
            ->whereHas('servicios', function($query){
                $query->where('cat_ser', 'modelo');
                });
        } */
        
        $plan = Pedido::with('user', 'servicios')->where('user_id', $user->id)
            ->whereHas('servicios', function($query){
                $query->where('cat_ser', 'empresa')
                      ->where('sub_cat', 'planes');
                    })->first();

        /* if ($this->sort_by) {
            $pedidos->orderBy($this->sort_by, $this->sortDirection);
        }
        else {
            $pedidos->orderBy('fec_ini', 'desc');
        } */

        return view('livewire.plan-index', compact('plan'));
    }
}
