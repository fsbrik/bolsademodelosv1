<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Modelo;
use App\Models\Contratacion;
use App\Models\Confirmacion;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ModeloContratacionIndex extends Component
{
    use WithPagination;

    public $confirmaciones, $confirmacion = null;
    public $modelo;

    public function mount()
    {
        
        //$user = Auth::user();

        $this->modelo = Modelo::where('user_id', Auth::user()->id)->first();
        
        //dd($this->contrataciones);
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

    public function obtenerModelosConfirmados($contratacion)
    {
        return $contratacion->modelos->where('confirmada', true)->count();
    }

    public function confirmacion_display($contratacion)
    {   
        // estado de la confirmacion
        $confirmacion = Confirmacion::where('contratacion_id', $contratacion->id)->where('modelo_id', $this->modelo->id)->pluck('estado')->get(0);
        return ($confirmacion === null) ? 'Pendiente' : ($confirmacion == 1 ? 'Aceptado' : 'Rechazado');
    }

    // le coloca la clase correspondiente al estado de la confirmacion_display
    public function getClassForConfirmation($contratacion)
    {
        $estado = $this->confirmacion_display($contratacion);
        if ($estado === 'Pendiente') {
            return 'text-slate-500';
        } elseif ($estado === 'Aceptado') {
            return 'text-green-500';
        } else {
            return 'text-red-500';
        }
    }

    public function confirmar($contratacion, $respuesta)
    {
        // estado de la confirmacion
        Confirmacion::where('contratacion_id', $contratacion['id'])->where('modelo_id', $this->modelo->id)->update(['estado' => $respuesta]);

    }

    public function destroy($contratacionId)
    {
        $user = Auth::user();
        $contratacion = Contratacion::findOrFail($contratacionId);
        $contratacion->delete();

        $contrataciones = Contratacion::with(['empresa', 'modelos'])
            ->whereHas('empresa', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->orderBy('fec_con', 'desc') // Opcional: ordenar por fecha de contratación
            ->paginate(10);
        return view('livewire.empresa-contratacion-index', compact('contrataciones'))->with('message', 'contratación n° '.$contratacion->id.' eliminada');
        

    }
    
    public function render()
    {
        $user = Auth::user();

        $contrataciones = Contratacion::with(['empresa', 'modelos', 'confirmaciones'])
            ->whereHas('modelos', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->orderBy('fec_con', 'desc') // Opcional: ordenar por fecha de contratación
            ->paginate(10);
            
          
        return view('livewire.modelo-contratacion-index', compact('contrataciones'));
    } 
   
}
