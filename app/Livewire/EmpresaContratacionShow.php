<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Contratacion;
use App\Models\Confirmacion;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EmpresaContratacionShow extends Component
{
    use WithPagination;

    public $contratacion, $contratacionId, $modelos, $empresa;

    public function mount($contratacionId)
    {
        $this->contratacionId = $contratacionId;
        $this->contratacion = Contratacion::findOrFail($contratacionId);        
        $this->modelos = $this->contratacion->modelos->all();
        $this->empresa = $this->contratacion->empresa;    
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
    
     // mostrar el estado de la confirmacion de la modelo
     public function confirmacionEstado($modelo)
     {
         $confirmacion = Confirmacion::where('contratacion_id', $this->contratacionId)->where('modelo_id', $modelo->id);
         $estadoDeConfirmacion = $confirmacion->pluck('estado')->get(0);
         $estadoDeConfirmacion = $estadoDeConfirmacion === null ? 'Pendiente' : ($estadoDeConfirmacion === 1 ? 'Aceptado' : 'Rechazado');
         return $estadoDeConfirmacion;
     }

    public function destroy()
    {
        $this->contratacion->delete();
        return redirect()->route('empresas.contrataciones.index')->with('message', 'contratación n° '.$this->contratacion->id.' eliminada');
    }

    public function render()
    {   
        return view('livewire.empresa-contratacion-show');
    }
}
