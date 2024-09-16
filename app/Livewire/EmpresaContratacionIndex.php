<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Modelo;
use App\Models\Contratacion;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class EmpresaContratacionIndex extends Component
{
    use WithPagination;

    public $action, $contratacionId;

    public function mount()
    {
        if (session()->get('contratacion') == 'contratCreate'){
            $this->action = 'contratCreate';
        } elseif (session()->get('contratacion') == 'contratEdit'){
            $this->action = 'contratEdit';//dd(session()->get('contratacionId'));
            $this->contratacionId = session()->get('contratacionId');
        } elseif (session()->get('contratacion') === null){
            $this->action = 'contratCreateNew';
        }
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

        $contrataciones = Contratacion::with(['empresa', 'modelos'])
            ->whereHas('empresa', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->orderBy('fec_con', 'desc') // Opcional: ordenar por fecha de contratación
            ->paginate(10);
        return view('livewire.empresa-contratacion-index', compact('contrataciones'));
    }
}
