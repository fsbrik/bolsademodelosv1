<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Modelo;
use App\Models\Contratacion;
use App\Models\Confirmacion;
use App\Models\Pedido;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class EmpresaContratacionIndex extends Component
{
    use WithPagination;

    public $action, $contratacionId, $planContratado, $user; //$conf_ini;

    public function mount()
    {       
        $this->user = Auth::user();

        $this->checkCreateOrEdit();
    }

    public function obtenerFechaFormateada($fecha)
    {
        return Carbon::parse($fecha)->format('d/m/Y');
    }

    public function obtenerDiasTrabajo($contratacion)
    {
        return Carbon::parse($contratacion->fec_ini)->diffInDays(Carbon::parse($contratacion->fec_fin)) + 1;
    }

    public function obtenerHorasTotales($contratacion)
    {
        $diasTrabajo = $this->obtenerDiasTrabajo($contratacion);
        return $contratacion->hor_dia * $diasTrabajo;
    }

    public function obtenerCostoPorHora($contratacion)
    {
        $horasTotales = $this->obtenerHorasTotales($contratacion);
        return $horasTotales ? $contratacion->mon_tot / $horasTotales : 0;
    }

    public function obtenerDescripcionCorta($contratacion)
    {
        return Str::limit($contratacion->des_tra, 30);
    }

    public function obtenerEstadoContratacion($contratacion)
    {
        return $contratacion->estado ? 'Abierta' : 'Finalizada';
    }

    public function obtenerClaseEstado($contratacion)
    {
        return $contratacion->estado ? 'text-green-600 font-bold' : 'text-red-600 font-bold underline';
    }

    // contar la cantidad de modelos que confirmaron en las contrataciones durante un plan contratado
    public function finalizarPorConfirmaciones($nombrePlan)
    {
        /* $confirmacionesTotales = 0;

        // recibo las contrataciones desde el metodo render
        $contrataciones->each(function($contratacion) use (&$confirmacionesTotales){
            // hacer el total de las confirmaciones de la contratacion menos las confirmaciones iniciales (que provienen del plan anterior)
            $confirmacionesPorContratacion = $contratacion->confirmaciones->where('estado', 1)->where('visto', 1)->count();// - $contratacion->conf_ini;
            $confirmacionesTotales += $confirmacionesPorContratacion;                                                          
        }); */

        //$confirmacionesTotales -= $this->conf_ini;//dd($confirmacionesTotales, $this->planContratado->conf_ini);
        switch($nombrePlan)
        {
            case 'plan simple':
                return $this->planContratado->conf_ini === 1 ? true : false;
                break;

            case 'plan mensual':
                return $this->planContratado->conf_ini === 5 ? true : false;
                break;
        }
    }

    // actualiza el estado de modelos que confirmaron la contratacion
    public function obtenerModelosConfirmados($contratacion)
    {
        return $contratacion->confirmaciones->where('estado', 1)->count();
    }

    // verifica si hay modelos que confirmaron una contratacion
    public function checkConfirmacion($contratacion)
    {
        $modelosConfirmados = $contratacion->confirmaciones->where('estado', 1)->count();
        return $modelosConfirmados > 0 ? false : true;
    }

    public function establecerVisto()
    {
        // Obtener las IDs de las contrataciones que cumplen con los criterios
        $contratacionIds = Contratacion::whereHas('empresa', function ($query){
            $query->where('user_id', $this->user->id);
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

    public function checkPlanContratado()
    {
        //$user = Auth::user();

        // obtener el ultimo plan contratado
        $this->planContratado = Pedido::whereHas('servicios', function ($query) {
            $query->where('sub_cat', 'planes');
            })->where('user_id', $this->user->id)->where('habilita', 1)->orderBy('created_at', 'desc')->first();
    }
    
    // actualiza el estado del plan contratado (en caso de tener uno). Podria haberlo denominado como updateHabilitacion.
    public function actualizarEstadoUltimoPlanContratado($contrataciones)
    {
        $this->checkPlanContratado();   
        
        // si el plan contratado no es null, lo actualizo
        if($this->planContratado)
        {
           // obtener el nombre del plan
           $nombrePlan = $this->planContratado->servicios->first()->nom_ser;

           // inicializar conf_ini
           //$this->conf_ini = $this->planContratado->conf_ini;

           switch($nombrePlan)
           {
                case 'plan simple':
                    $comprobarFec_fin = false; // no aplica para este plan
                    $comprobarConfirmaciones = $this->finalizarPorConfirmaciones($nombrePlan);
                    break;
                case 'plan mensual':
                    $comprobarFec_fin = Carbon::today()->gt(Carbon::parse($this->planContratado->fec_fin)) ? true : false;
                    $comprobarConfirmaciones = $this->finalizarPorConfirmaciones($nombrePlan);
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
        }
    }

    // permite crear una contratacion, editar y eliminar dependiendo el plan que tenga contratado
    // en caso de no tener un plan contratado, no podra hacer ninguna de estas acciones
    /* public function checkHabilitacion()
    {
        //$user = Auth::user();
        $planContratado = Pedido::whereHas('servicios', function ($query) {
            $query->where('sub_cat', 'planes');
            })->where('user_id', $this->user->id)->where('habilita', 1)->first();
        return $planContratado ? true : false;        
    } */

    // verifica si le quedan créditos al plan
    public function checkCreditos()
    {
        return isset($this->planContratado) && $this->planContratado->creditos ? true : false;
    }


    // actualizar el estado de las contrataciones
    // se cierra la contratacion en caso que se supere la fec_fin o en caso que coincidan la cantidad de modelos que confirmaron con la cantidad de modelos a contratar
    public function updateEstadoContratacion($contrataciones)
    {

        $this->checkPlanContratado();

        if(!$this->planContratado)
        {
            Contratacion::whereIn('id', $contrataciones->pluck('id'))->update(['estado' => 0]);
            return;
        }

        $contrataciones->each(function($contratacion){

            $confirmaciones = $contratacion->confirmaciones->where('estado', 1)->count();

            if($this->checkFecFinContratacion($contratacion) || $confirmaciones == $contratacion->cant_mod)
            {
                $contratacion->update([
                    'estado' => 0
                ]);
            }
            elseif(!$this->checkFecFinContratacion($contratacion) || $confirmaciones < $contratacion->cant_mod)
            {
                $contratacion->update([
                    'estado' => 1
                ]);
            }
        });
    }

    // permite editar o eliminar una contratacion dependiendo si la fec_fin esta vencida.
    public function checkFecFinContratacion(Contratacion $contratacion)
    {
        return Carbon::today()->gt(Carbon::parse($contratacion->fec_fin)) ? true : false;
    }

    public function checkCreateOrEdit()
    {
        if (session()->get('contratacion') == 'contratCreate'){
            $this->action = 'contratCreate';
        } elseif (session()->get('contratacion') == 'contratEdit'){
            $this->action = 'contratEdit';
            $this->contratacionId = session()->get('contratacionId');
        } elseif (session()->get('contratacion') === null){
            $this->action = 'contratCreateNew';
        }
    }

    public function destroy($contratacionId)
    {
        //$user = Auth::user();
        $contratacion = Contratacion::findOrFail($contratacionId);
        $this->planContratado->creditos += $contratacion->cant_mod;
        $this->planContratado->save();
        $contratacion->delete();
        session()->flash('error', 'contratación n° '.$contratacionId.' eliminada');

        /* $contrataciones = Contratacion::with(['empresa', 'modelos'])
            ->whereHas('empresa', function ($query){
                $query->where('user_id', $this->user->id);
            })
            ->orderBy('fec_con', 'desc') // Opcional: ordenar por fecha de contratación
            ->paginate(10);
        return view('livewire.empresa-contratacion-index', compact('contrataciones'))->with('message', 'contratación n° '.$contratacion->id.' eliminada'); */
    }

    
    
    public function render()
    {
        //$user = Auth::user();

        $contrataciones = Contratacion::with(['empresa', 'modelos'])
            ->whereHas('empresa', function ($query){
                $query->where('user_id', $this->user->id);
            })
            ->orderBy('fec_con', 'desc') // Opcional: ordenar por fecha de contratación
            ->paginate(10);
        
        // actualizar el estado de cada contratacion    
        $this->updateEstadoContratacion($contrataciones);

        // actualizar el estado del plan
        $this->actualizarEstadoUltimoPlanContratado($contrataciones);      

        return view('livewire.empresa-contratacion-index', compact('contrataciones'));
    }
}
