<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Modelo;
use App\Models\Contratacion;
use App\Models\Confirmacion;
//use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ModeloContratacionShow extends Component
{
    //use WithPagination;

    public $contratacion, $modelo, $empresa;

    public function mount($contratacionId)
    {
        $this->contratacion = Contratacion::findOrFail($contratacionId);        
        $this->modelo = Auth::user()->modelo;
        $this->empresa = $this->contratacion->empresa;
        //dd($this->empresa);
      
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

    public function cambiarBgEstado($contratacion)
    {
        // estado de la confirmacion
        $confirmacion = $this->getConfirmacion($contratacion);
        $estado = $confirmacion ? $confirmacion->estado : null;
        
        return ($estado === null) ? 'bg-slate-200' : ($estado == 1 ? 'bg-green-500' : 'bg-red-500');
    }

    public function confirmacion_display($contratacion)
    {
        // estado de la confirmacion
        $confirmacion = $this->getConfirmacion($contratacion);
        $estado = $confirmacion ? $confirmacion->estado : null;

        return ($estado === null) ? 'Pendiente' : ($estado == 1 ? 'Aceptada' : 'Rechazada');
    }
    
    public function getConfirmacion($contratacion)
    {
        return Confirmacion::where('contratacion_id', $contratacion->id)
            ->where('modelo_id', $this->modelo->id)
            ->first();
    }
    
    public function getButtonClass($contratacion, $tipo)
    {
        $estado = $this->confirmacion_display($contratacion);
        
        if ($tipo === 'aceptar') {
            return $estado === 'Aceptada' ? 'hidden' : '';
        } elseif ($tipo === 'rechazar') {
            return $estado === 'Rechazada' ? 'hidden' : '';
        }
        
        return '';
    }
    
    public function getIconClass($contratacion, $tipo)
    {
        $estado = $this->confirmacion_display($contratacion);
        
        if ($tipo === 'aceptar') {
            return $estado === 'Pendiente' || $estado === 'Rechazada' ? 'fa-solid fa-handshake text-slate-700 p-2 rounded-lg bg-green-500' : '';
        } elseif ($tipo === 'rechazar') {
            return $estado === 'Pendiente' || $estado === 'Aceptada' ? 'fa-solid fa-thumbs-down text-slate-700 p-2 rounded-lg bg-red-500' : '';
        }
    
        return '';
    }

    
    public function confirmar($contratacionId, $respuesta)
    {
        // estado de la confirmacion
        Confirmacion::where('contratacion_id', $contratacionId)->where('modelo_id', $this->modelo->id)->update(['estado' => $respuesta]);
        if(!$respuesta)
        {
            $contratacion = Contratacion::findOrFail($contratacionId);
            $contratacion->update(['estado' => 1]);
        }

    }

    public function visto($contratacion)
    {
        // devuelve el valor de visto que por defecto es 0 y si la empresa vió los datos de la modelo es 1
        return $contratacion->confirmaciones->where('modelo_id', $this->modelo->id)->value('visto');
    }

    /* public function destroy()
    {
        $this->contratacion->delete();
        return redirect()->route('empresas.contrataciones.index')->with('message', 'contratación n° '.$this->contratacion->id.' eliminada');
    } */

    public function render()
    {   
        return view('livewire.modelo-contratacion-show');
    }
}
