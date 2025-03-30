<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Contratacion;
use App\Models\Confirmacion;
use App\Models\Pedido;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EmpresaContratacionShow extends Component
{
    use WithPagination;

    public $planContratado, $contratacion, $contratacionId, $user, $empresa;

    /* public function mount($contratacionId)
    {
        $this->contratacionId = $contratacionId;
        $this->contratacion = Contratacion::findOrFail($contratacionId);        
        $this->modelos = $this->contratacion->modelos->all();
        $this->empresa = $this->contratacion->empresa;    
    } */

    public function mount()
    {
        $this->user = Auth::user();
        $this->checkPlanContratado();
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

    // permite editar o eliminar una contratacion dependiendo si la fec_fin esta vencida.
    public function checkFecFinContratacion(Contratacion $contratacion)
    {
        return Carbon::today()->gt(Carbon::parse($contratacion->fec_fin)) ? true : false;
    }
    

    
    
    
    public function getEstadoClass($modelo)
    {
        $estado = $this->confirmacionEstado($modelo);
        
        if ($estado === 'Pendiente') {
            return 'bg-slate-400 p-1 mt-2 rounded-md font-semibold text-center';
        } 
        elseif ($estado === 'Aceptado'){
            return 'bg-green-500 p-1 mt-2 rounded-md font-semibold text-center';
        }
        elseif ($estado === 'Rechazado') {
            return  'bg-red-500 p-1 mt-2 rounded-md font-semibold text-center';
        }
    
    }

    public function checkPlanContratado()
    {
        //$user = Auth::user();

        // obtener el ultimo plan contratado
        $this->planContratado = Pedido::whereHas('servicios', function ($query) {
            $query->where('sub_cat', 'planes');
            })->where('user_id', $this->user->id)->where('habilita', 1)->orderBy('created_at', 'desc')->first();
    }

    // mostrar el estado de la confirmacion de la modelo. Sirve para habilitar o deshabilitar el boton de "remover" en la vista.
    public function confirmacionEstado($modelo)
    {
        $estado = Confirmacion::where('contratacion_id', $this->contratacionId)->where('modelo_id', $modelo->id)->value('estado');

        // Mapeo de los posibles estados
        $estadoDeConfirmacion = [
            null => 'Pendiente',
            1 => 'Aceptado',
            0 => 'Rechazado'
        ];

        // Retornar el estado correspondiente
        return $estadoDeConfirmacion[$estado] ?? 'Pendiente';
    }

    public function establecerVisto($modeloId)
    {
        $confirmacion = Confirmacion::where('contratacion_id', $this->contratacion->id)->where('modelo_id', $modeloId)->first();
        if(!$confirmacion->visto)
        {
            $confirmacion->update(['visto' => 1]);
            $this->acumularConfIni();
            $this->finalizarPorConfirmaciones();
        }
    }

    // acumular la cantidad de vistos en conf_ini del plan contratado
    public function acumularConfIni()
    {
        $this->planContratado->increment('conf_ini');
    }

    public function finalizarPorConfirmaciones()
    {
        // obtener el nombre del plan
        $nombrePlan = $this->planContratado->servicios->first()->nom_ser;
        
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

    public function destroy()
    {
        $this->planContratado->creditos += $this->contratacion->cant_mod;
        $this->planContratado->save();
        $this->contratacion->delete();
        return to_route('empresas.contrataciones.index')->with('error', 'contratación n° '.$this->contratacion->id.' eliminada');
    }

    public function render()
    {
        $this->contratacion = Contratacion::findOrFail($this->contratacionId);
        $modelos = $this->contratacion->modelos()->orderByRaw('CAST(SUBSTRING(mod_id, 4) AS UNSIGNED) ASC')->paginate(9);
        $this->empresa = $this->contratacion->empresa;

        return view('livewire.empresa-contratacion-show', [
            'modelos' => $modelos, // Asegúrate de pasar modelos a la vista
            'empresa' => $this->empresa, // Asegúrate de pasar empresa a la vista
            'contratacion' => $this->contratacion, // Asegúrate de pasar contratacion a la vista
        ]);
    }

}
