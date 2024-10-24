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

    public $contratacion, $contratacionId, $empresa;

    /* public function mount($contratacionId)
    {
        $this->contratacionId = $contratacionId;
        $this->contratacion = Contratacion::findOrFail($contratacionId);        
        $this->modelos = $this->contratacion->modelos->all();
        $this->empresa = $this->contratacion->empresa;    
    } */

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
        return Carbon::now()->gt(Carbon::parse($contratacion->fec_fin)) ? false : true;
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
        $this->contratacion = Contratacion::findOrFail($this->contratacionId);
        $modelos = $this->contratacion->modelos()->paginate(9);
        $this->empresa = $this->contratacion->empresa;

        return view('livewire.empresa-contratacion-show', [
            'modelos' => $modelos, // Asegúrate de pasar modelos a la vista
            'empresa' => $this->empresa, // Asegúrate de pasar empresa a la vista
            'contratacion' => $this->contratacion, // Asegúrate de pasar contratacion a la vista
        ]);
    }

}
