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
        $estado = Confirmacion::where('contratacion_id', $contratacion->id)->where('modelo_id', $this->modelo->id)->value('estado');        
        return $estado === null ? 'Pendiente' : ($estado == 1 ? 'Aceptada' : 'Rechazada');
    }

    // le coloca la clase correspondiente al estado de la confirmacion_display
    public function getClassForConfirmation($contratacion)
    {
        $estado = $this->confirmacion_display($contratacion);
        if ($estado === 'Pendiente') {
            return 'text-slate-500';
        } elseif ($estado === 'Aceptada') {
            return 'text-green-500';
        } else {
            return 'text-red-500';
        }
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
            return $estado === 'Pendiente' ? 'fa-solid fa-handshake text-slate-500 p-2 rounded-lg bg-green-300' : 'fa-solid fa-handshake text-slate-500 p-2 rounded-lg bg-green-300';
        } elseif ($tipo === 'rechazar') {
            return $estado === 'Pendiente' ? 'fa-solid fa-thumbs-down text-slate-500 p-2 rounded-lg bg-red-400' : 'fa-solid fa-thumbs-down text-slate-500 p-2 rounded-lg bg-red-400';
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
        /* $contratacion = Contratacion::findOrFail($contratacionId);
        $user = $contratacion->empresa->user;
        $respuesta ? $user->givePermissionTo('modelos.datos_de_contacto') : $user->revokePermissionTo('modelos.datos_de_contacto');*/ 
    }

    public function visto($contratacion)
    {
        // devuelve el valor de visto que por defecto es 0 y si la empresa vió los datos de la modelo es 1
        return $contratacion->confirmaciones->where('modelo_id', $this->modelo->id)->value('visto');
    }

    // actualizar el estado de las contrataciones
    // se cierra la contratacion en caso que se supere la fec_fin o en caso que coincidan la cantidad de modelos que confirmaron con la cantidad de modelos a contratar
    public function updateEstadoContratacion($contrataciones)
    {

        $contrataciones->each(function($contratacion){

            $confirmaciones = $contratacion->confirmaciones->where('estado', 1)->count();

            if(Carbon::now()->gt(Carbon::parse($contratacion->fec_fin)) || $confirmaciones == $contratacion->cant_mod)
            {
                $contratacion->update([
                    'estado' => 0
                ]);
            }
            elseif(Carbon::now()->lessThanOrEqualTo(Carbon::parse($contratacion->fec_fin)) || $confirmaciones < $contratacion->cant_mod)
            {
                $contratacion->update([
                    'estado' => 1
                ]);
            }
        });
    }

    /* public function destroy($contratacionId)
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
        

    } */
    
    /* public function render()
    {
        $user = Auth::user();

        $contrataciones = Contratacion::with(['empresa', 'modelos', 'confirmaciones'])
            ->whereHas('modelos', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('estado', 1)            
            ->orderBy('fec_con', 'desc') // Opcional: ordenar por fecha de contratación
            ->paginate(10);
        
        // actualizar el estado de cada contratacion    
        //$this->updateEstadoContratacion($contrataciones);
            
          
        return view('livewire.modelo-contratacion-index', compact('contrataciones'));
    }  */
   
    public function render()
    {
        $user = Auth::user();
    
        $contrataciones = Contratacion::with(['empresa', 'modelos', 'confirmaciones'])
            ->whereHas('modelos', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where(function($query) use ($user) {
                $query->where('estado', 1)
                      ->orWhere(function($query) use ($user) {
                          $query->where('estado', 0)
                                ->whereHas('confirmaciones', function ($confirmacion) use ($user) {
                                    $confirmacion->where('estado', 1)
                                                 ->where('modelo_id', $user->modelo->id);
                                });
                      });
            })
            ->orderBy('fec_con', 'desc')
            ->paginate(10);
    
        return view('livewire.modelo-contratacion-index', compact('contrataciones'));
    }
    

}
