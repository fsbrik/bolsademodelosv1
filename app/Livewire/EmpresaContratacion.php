<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Modelo;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class EmpresaContratacion extends Component
{
    use WithPagination;

    public $fec_ini, $fec_fin, $hor_dia, $dom_tra, $loc_tra, $pro_tra, $pai_tra, $mon_tot, $des_tra;     
    public $dias_trabajo, $valor_hora; 

    protected $rules = [
        'fec_ini' => 'required|date',
        'fec_fin' => 'required|date|after_or_equal:fec_ini',
        'hor_dia' => 'required|integer|min:1|max:24',
        'dom_tra' => 'required|string|max:255',
        'loc_tra' => 'required|string|max:255',
        'pro_tra' => 'required|string|max:255',
        'pai_tra' => 'required|string|max:255',
        'mon_tot' => 'required|numeric|min:0',
        'des_tra' => 'required|string|max:1000',
    ];

    public function updatedFecIni()
    {
        $this->calcularDiasTrabajo();
        $this->calcularValorHora();
    }

    public function updatedFecFin()
    {
        $this->calcularDiasTrabajo();
        $this->calcularValorHora();
    }

    public function updatedHorDia()
    {
        $this->calcularValorHora();
    }

    public function updatedMonTot()
    {
        $this->calcularValorHora();
    }

    public function calcularDiasTrabajo()
    {
        if ($this->fec_ini && $this->fec_fin) {
            $this->dias_trabajo = Carbon::parse($this->fec_ini)->diffInDays(Carbon::parse($this->fec_fin)) + 1;
        } else {
            $this->dias_trabajo = 0;
        }
    }

    public function calcularValorHora()
    {
        if ($this->hor_dia && $this->mon_tot && $this->dias_trabajo > 0) {
            $this->valor_hora = $this->mon_tot / ($this->hor_dia * $this->dias_trabajo);
        } else {
            $this->valor_hora = 0;
        }
    }

    public function render()
    {   $intentos = 10;

        if($intentos >= 10){
            $modelos = Modelo::paginate(10);
            $pagination = true;
        } else {
            $modelos = Modelo::take($intentos)->get();
        }

        return view('livewire.empresa-contratacion', compact('modelos', 'pagination'));
    }
}
