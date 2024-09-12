<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Modelo;
use App\Models\Contratacion;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EmpresaContratacionShow extends Component
{
    use WithPagination;

    public $contratacion, $modelos, $empresa;

    // variables para create
    /* public $fec_con, $fec_ini, $fec_fin, $hor_dia, $dom_tra, $loc_tra, $pro_tra, $pai_tra, $mon_tot, $des_tra;     
    public $dias_trabajo, $valor_hora; 
    public $empresa, $empresas;
    public $modelos, $pagination; */



    
    

    public function mount($contratacionId)
    {
        $this->contratacion = Contratacion::findOrFail($contratacionId);        
        $this->modelos = $this->contratacion->modelos->all();
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

    public function obtenerModelosConfirmados($contratacion)
    {
        return $contratacion->modelos->where('confirmada', true)->count();
    }

    public function destroy()
    {
        $this->contratacion->delete();
        return redirect()->route('empresas.contrataciones.index')->with('message', 'contratación n° '.$this->contratacion->id.' eliminada');
    }

    public function render()
    {   //$modelos = Modelo::all();//$this->contratacion->modelos->all();
        return view('livewire.empresa-contratacion-show');
    }
}
