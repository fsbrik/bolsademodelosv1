<?php

namespace App\Livewire\Planes;

use Livewire\Component;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class PlanIndex extends Component
{
    /* use WithPagination;

    public $searchTerm;
    public $sort_by = null;
    public $sortDirection = 'asc';
    public $perPage = 10; */

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

    public function mostrarCreditos(Pedido $plan)
    {
        $nombrePlan = $plan->servicios->first()->nom_ser;
        if($plan->habilita === null)
        {
            return '-';
        }
        else // habilita puede ser 0 o 1, se muestra el mismo mensaje
        {
            return $nombrePlan == 'plan anual' ? 'infinito' : $plan->creditos;
        }
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
        /* $user = Auth::user();
        
        $plan = Pedido::where('user_id', $user->id)
            ->whereHas('servicios', function($query){
                $query->where('cat_ser', 'empresa')
                      ->where('sub_cat', 'planes');
                    })
                    ->where(function($query) {
                        $query->where('habilita', '<>', 0)
                              ->orWhereNull('habilita');
                    })->orderBy('created_at', 'desc')->first(); */

        return view('livewire.planes.plan-index');//, compact('plan')
    }
}
