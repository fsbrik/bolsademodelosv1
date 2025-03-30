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

    public $searchTerm, $sort_by = 'habilita', $sortDirection = 'asc', $perPage = 10;
    public $planContratado;
    public $nombreBoton;

    /* public function mount()
    {
        
    } */

    public function updating($field)
    {
        if (in_array($field, [
            'searchTerm'
        ])) {
            $this->resetPage();
        }
    }

    // no entiendo por que no pude hacer funcionar este metodo
    /* public function tacharPlanAgotado(Pedido $pedido)
    {
        if($pedido->habilita === 0)
        {
            return 'decoration-red-700 decoration-2 line-through';
        }

        return '';
    } */

    /* public function actualizarEstadoUltimoPlanContratado(Pedido $pedido)
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
                    $comprobarFec_fin = Carbon::today()->lt(Carbon::parse($pedido->fec_fin)) ? true : false;
                    //comprobamos si se quedo sin creditos
                    $comprobarCreditos = $pedido->creditos > 0 ? true : false;
                    break;
                
                case 'plan anual':
                    // comprobamos que no se haya vencido el fec_fin
                    $comprobarFec_fin = Carbon::today()->lt(Carbon::parse($pedido->fec_fin)) ? true : false;
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

                // sabiendo que se deshabilito el plan, actualizo el visto solamente cuando la deshabilitacion proviene de la fec_fin
                if ($comprobarFec_fin)
                {
                    $this->establecerVisto();
                }
            }
    } */

    /* public function contarConfirmaciones()
    {
        // Obtener las IDs de las contrataciones que cumplen con los criterios
        $contratacionIds = Contratacion::whereHas('empresa', function ($query){
            $query->where('user_id', $this->user->id);
            })
            ->whereHas('confirmaciones', function ($query) {
                $query->where('estado', 1)->where('visto', 0);
            })
            ->pluck('id');

        $confirmacionesTotales = 0;

        // recibo las contrataciones desde el metodo render
        $contrataciones->each(function($contratacion) use (&$confirmacionesTotales){
            // hacer el total de las confirmaciones de la contratacion menos las confirmaciones iniciales (que provienen del plan anterior)
            $confirmacionesPorContratacion = $contratacion->confirmaciones->where('estado', 1)->where('visto', 1)->count();// - $contratacion->conf_ini;
            $confirmacionesTotales += $confirmacionesPorContratacion;                                                          
        });

        $confirmacionesTotales -= $this->conf_ini;//dd($confirmacionesTotales, $this->planContratado->conf_ini);
        return $confirmacionesTotales;
    } */

    // actualiza el estado del plan contratado (en caso de tener uno). Podria haberlo denominado como updateHabilitacion.
    /* public function actualizarEstadoUltimoPlanContratado(Pedido $pedido)
    {
        // obtener el nombre del plan
        $nombrePlan = $pedido->servicios()->where('pedido_id', $pedido->id)->first()->nom_ser;

           switch($nombrePlan)
           {
                case 'plan simple':
                    $comprobarFec_fin = false; // no aplica para este plan
                    $comprobarConfirmaciones = $this->contarConfirmaciones($contrataciones) === 1 ? true : false;
                    break;
                case 'plan mensual':
                    $comprobarFec_fin = Carbon::today()->gt(Carbon::parse($this->planContratado->fec_fin)) ? true : false;
                    $comprobarConfirmaciones = $this->contarConfirmaciones($contrataciones) === 5 ? true : false;
                    break;
                case 'plan anual':
                    $comprobarFec_fin = Carbon::today()->gt(Carbon::parse($this->planContratado->fec_fin)) ? true : false;
                    $comprobarConfirmaciones = false; // no aplica para este plan
                    break;
           }

            // si le confirmaron la cantidad de modelos maxima que permite el plan o se le vencio el plan
            if ($comprobarFec_fin || $comprobarConfirmaciones)
            {
                $this->planContratado->update([
                    'habilita' => 0
                ]);

                // también se desactivan todas las contrataciones activas
                $contrataciones->where('estado', 1)->each(function($contratacion){
                    $contratacion->update(['estado' => 0]);
                });

                // sabiendo que se deshabilito el plan, actualizo el visto solamente cuando la deshabilitacion proviene de la fec_fin
                if ($comprobarFec_fin)
                {
                    $this->establecerVisto();
                }
            }
    } */

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
    public function establecerVisto(Pedido $pedido)
    {
        $userId = $pedido->user_id;

        // Obtener las IDs de las contrataciones que cumplen con los criterios
        $contratacionIds = Contratacion::whereHas('empresa', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->whereHas('confirmaciones', function ($query) {
            $query->where('estado', 1)->where('visto', '=', 0);
        })
        ->pluck('id');

        // Actualizar las confirmaciones de esas contrataciones
        Confirmacion::whereIn('contratacion_id', $contratacionIds)
        ->where('visto', '=', 0)
        ->update(['visto' => 1]);
    }

    public function deshabilitarContrataciones(Pedido $pedido)
    {
        $userId = $pedido->user_id;
        $contrataciones = Contratacion::whereHas('empresa', function($query) use ($userId){
            $query->where('user_id', $userId);
        })->where('estado', 1)->update(['estado' => 0]);

    }

    public function inicializarConfirmaciones(Pedido $pedido)
    {
        $userId = $pedido->user_id;
        $fechaActual = Carbon::today();
        
        /* $confirmaciones = Contratacion::whereHas('empresa', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('fec_fin', '>', $fechaActual)
            ->with('confirmaciones') // Pre-cargar las confirmaciones para evitar múltiples consultas a la base de datos
            ->get()
            ->sum(function ($contratacion) {
                return $contratacion->confirmaciones->where('estado', 1)->count();
            }); 
        
        $pedido->update(['conf_ini' => $confirmaciones]);*/
        $contrataciones = Contratacion::whereHas('empresa', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->where('fec_fin', '>=', $fechaActual)
        ->with('confirmaciones') // Carga previa de la relación confirmaciones
        ->get();

        $contrataciones->each(function($contratacion){
                $contratacion->cant_mod = $contratacion->confirmaciones->where('estado', 1)->count();
                $contratacion->save();
            });
    
        
    }

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
                //$fec_fin = Carbon::now()->addDays(30)->format('Y-m-d');
                $fec_fin = Carbon::today()->addDays(30);
                $creditos = 5;
                //$this->removerPendientesEnContratacionesActivas($pedido); // elimina todas las modelos pendientes que quedaron en las contrataciones activas
                break;
            case 'plan anual':
                //$fec_fin = Carbon::now()->addDays(365)->format('Y-m-d');
                $fec_fin = Carbon::today()->addDays(365);
                $creditos = 10000; // en realidad es infinito
                break;
        }

        if($pedido->habilita === null || $pedido->habilita == 0)
        {
            $pedido->update([
                'habilita' => 1,
                'fec_ini' => Carbon::today(),//now()->format('Y-m-d'),
                'fec_fin' => $fec_fin,
                'conf_ini' => 0,
                'creditos' => $creditos]);
            
            $this->inicializarConfirmaciones($pedido);
                
            session()->flash('message', 'El plan del usuario '.$pedido->user->name.' ha sido habilitado exitosamente');
        } 
        else
        {
            $pedido->update([
                'habilita' => null,
                'fec_ini' => null,
                'fec_fin' => null,
                'conf_ini' => 0,
                'creditos' => null]);

            $this->deshabilitarContrataciones($pedido);
            $this->establecerVisto($pedido);

            session()->flash('message', 'Se deshabilitó el plan del usuario '.$pedido->user->name);
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

       /* // Obtener todos los pedidos primero
        $pedidosCollection = $pedidos->get();

        // Ejecuta la acción solo en los pedidos que tienen habilita en 1
        $pedidosCollection->filter(function($pedido) {
            return $pedido->habilita == 1;
        })->each(function($pedido) {
            $this->actualizarEstadoUltimoPlanContratado($pedido);
        }); */


        $pedidos = $pedidos->paginate($this->perPage);

        
    
        return view('livewire.admin.habilitar-planes', compact('pedidos'));
    }
}
