<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Empresa;
use App\Models\Pedido;
use App\Models\Servicio;
use App\Models\Contratacion;
use App\Models\Confirmacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Livewire\WithPagination;

class HabilitarPlanes extends Component
{
    use WithPagination;

    public $searchTerm;
    public $sort_by = 'habilita';
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

    public function tacharPlanAgotado(Pedido $pedido)
    {
        // si alguno de los parametros no es null
        if (!$pedido->habilita && ($pedido->fec_fin !== null || $pedido->creditos !== null))
        {
            echo 'class="decoration-red-700 decoration-2 line-through"';
        }
    }

    public function actualizarEstadoUltimoPlanContratado(Pedido $pedido)
    {
            // obtener el nombre del plan
            $nombrePlan = $pedido->servicios()->where('pedido_id', $pedido->id)->first()->nom_ser;

            //dependiendo del plan seleccionado se le da un tratamiento distinto
            switch ($nombrePlan)
            {
                case 'plan simple':
                    // el plan simple no tiene fec_fin, por lo tanto no se comprueba, por ende siempre va a ser true
                    $comprobarFec_fin = true;
                    //comprobamos si se quedo sin creditos
                    $comprobarCreditos = $pedido->creditos > 0 ? true : false;
                    break;
                
                case 'plan mensual':
                    // comprobamos que no se haya vencido el fec_fin
                    $comprobarFec_fin = Carbon::now()->lt(Carbon::parse($pedido->fec_fin)) ? true : false;
                    //comprobamos si se quedo sin creditos
                    $comprobarCreditos = $pedido->creditos > 0 ? true : false;
                    break;
                
                case 'plan anual':
                    // comprobamos que no se haya vencido el fec_fin
                    $comprobarFec_fin = Carbon::now()->lt(Carbon::parse($pedido->fec_fin)) ? true : false;
                    // el plan anual tiene creditos infinitos, por lo tanto no se comprueba, por ende siempre va a ser true
                    $comprobarCreditos = true;
                    break;
            }

            // si se le terminaron los creditos o se vencio el plan
            if ($comprobarFec_fin === false || $comprobarCreditos === false)
            {
                $pedido->update([
                    'habilita' => 0
                ]);
            }
    }

    // cuando se le habilita un plan a un cliente, hay que quitar todas las modelos pendientes en las contrataciones que quedaron activas.
    // Excepto si el plan habilitado es el anual.
    /* public function removerPendientesEnContratacionesActivas(Pedido $pedido)
    {
        $userId = $pedido->user_id;
        $empresas = Empresa::where('user_id', $userId)->get();

        $empresas->each(function($empresa) {
            // Obtener todas las contrataciones activas de la empresa
            $contratacionesActivas = Contratacion::where('empresa_id', $empresa->id)->where('estado', 1)->get(); 
            
            // Si existen contrataciones activas
            if ($contratacionesActivas->isNotEmpty()) {
                // Eliminar confirmaciones pendientes y modelos asociadas a las contrataciones activas
                $contratacionesActivas->each(function($contratacion) {
                    // Obtener modelos con confirmaciones en estado null
                    $modelosParaEliminar = Confirmacion::where('contratacion_id', $contratacion->id)
                                                    ->whereNull('estado')
                                                    ->pluck('modelo_id');
                                                    //dd($contratacion->id);
                                                    dd($modelosParaEliminar);
                    // Si existen modelos a eliminar
                    if ($modelosParaEliminar->isNotEmpty()) {
                        // Eliminar las asociaciones de la tabla pivote para los modelos encontrados
                        $contratacion->modelos()->detach($modelosParaEliminar);
                    }

                    // También puedes eliminar las confirmaciones pendientes, si lo deseas
                    Confirmacion::where('contratacion_id', $contratacion->id)
                                ->where('estado', null)
                                ->delete();
                });
            }
        });
    } */




    public function habilitarPlan(Pedido $pedido)
    {   
        $planSeleccionado = $pedido->servicios->first()->nom_ser;
        
        switch ($planSeleccionado)
        {
            case 'plan simple':
                $fec_fin = null;
                $creditos = 1;
                //$this->removerPendientesEnContratacionesActivas($pedido); // elimina todas las modelos pendientes que quedaron en las contrataciones activas
                break;
            case 'plan mensual':
                $fec_fin = Carbon::now()->addDays(30)->format('Y-m-d');
                $creditos = 5;
                //$this->removerPendientesEnContratacionesActivas($pedido); // elimina todas las modelos pendientes que quedaron en las contrataciones activas
                break;
            case 'plan anual':
                $fec_fin = Carbon::now()->addDays(365)->format('Y-m-d');
                $creditos = 10000; // en realidad es infinito
                break;
        }

        if($pedido->habilita === null || $pedido->habilita == 0)
        {
            $pedido->update([
                'habilita' => 1,
                'fec_ini' => Carbon::now()->format('Y-m-d'),
                'fec_fin' => $fec_fin,
                'creditos' => $creditos]);
        } 
        else
        {
            $pedido->update([
                'habilita' => null,
                'fec_ini' => null,
                'fec_fin' => null,
                'creditos' => null]);
        }
    }

    //mostrar la cantidad de créditos según el plan seleccionado
    public function mostrarCreditos(Pedido $pedido)
    {       
        if($pedido->creditos == 10000)
        {
            return 'infinito';
        } else
        {   //dd($pedido->creditos);
            return $pedido->creditos ?? '-';
        }
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        session()->flash('message', 'se eliminó el plan de '.$pedido->user->name);
    }

    public function sortBy($field)
    {
        $this->resetPage();
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
                $query->where('cat_ser', 'empresa')
                      ->where('sub_cat', 'planes');
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

        // actualiza el estado del pedido
        $pedidos->where('habilita',1)->each(function($pedido){
                $this->actualizarEstadoUltimoPlanContratado($pedido);
        });


        $pedidos = $pedidos->paginate($this->perPage);

        
    
        return view('livewire.admin.habilitar-planes', compact('pedidos'));
    }
}
