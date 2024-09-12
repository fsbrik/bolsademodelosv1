<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Modelo;
use App\Models\Contratacion;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EmpresaContratacionEdit extends Component
{
    use WithPagination;

    // variables para create
    public $fec_con, $fec_ini, $fec_fin, $hor_dia, $dom_tra, $loc_tra, $pro_tra, $pai_tra, $mon_tot, $des_tra;     
    public $dias_trabajo, $valor_hora; 
    public $empresa, $empresas;
    public $parametrosContratacion;
    public $contratacion, $contratacionId, $modelosSeleccionadas;


    protected $rules = [
        'modelosSeleccionadas' => 'required',
        'empresa' => 'required|integer|min:1', 
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

    protected $messages = [
        'modelosSeleccionadas.required' => 'Debe seleccionar al menos 1 modelo o lo que permita tu plan',

        'empresa.required' => 'Debe seleccionar una empresa.',
        'empresa.integer' => 'La empresa debe ser un valor numérico.',
        'empresa.min' => 'Debe seleccionar una empresa válida.',
    
        'fec_ini.required' => 'La fecha de inicio es obligatoria.',
        'fec_ini.date' => 'La fecha de inicio debe ser una fecha válida.',
    
        'fec_fin.required' => 'La fecha de finalización es obligatoria.',
        'fec_fin.date' => 'La fecha de finalización debe ser una fecha válida.',
        'fec_fin.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la fecha de inicio.',
    
        'hor_dia.required' => 'La carga horaria por día es obligatoria.',
        'hor_dia.integer' => 'La carga horaria por día debe ser un valor numérico.',
        'hor_dia.min' => 'La carga horaria por día debe ser de al menos 1 hora.',
        'hor_dia.max' => 'La carga horaria por día no puede exceder las 24 horas.',
    
        'dom_tra.required' => 'La dirección del trabajo es obligatoria.',
        'dom_tra.string' => 'La dirección del trabajo debe ser un texto.',
        'dom_tra.max' => 'La dirección del trabajo no puede exceder los 255 caracteres.',
    
        'loc_tra.required' => 'La localidad del trabajo es obligatoria.',
        'loc_tra.string' => 'La localidad del trabajo debe ser un texto.',
        'loc_tra.max' => 'La localidad del trabajo no puede exceder los 255 caracteres.',
    
        'pro_tra.required' => 'La provincia del trabajo es obligatoria.',
        'pro_tra.string' => 'La provincia del trabajo debe ser un texto.',
        'pro_tra.max' => 'La provincia del trabajo no puede exceder los 255 caracteres.',
    
        'pai_tra.required' => 'El país del trabajo es obligatorio.',
        'pai_tra.string' => 'El país del trabajo debe ser un texto.',
        'pai_tra.max' => 'El país del trabajo no puede exceder los 255 caracteres.',
    
        'mon_tot.required' => 'El monto total ofrecido es obligatorio.',
        'mon_tot.numeric' => 'El monto total ofrecido debe ser un valor numérico.',
        'mon_tot.min' => 'El monto total ofrecido debe ser un valor positivo.',
    
        'des_tra.required' => 'La descripción del trabajo es obligatoria.',
        'des_tra.string' => 'La descripción del trabajo debe ser un texto.',
        'des_tra.max' => 'La descripción del trabajo no puede exceder los 1000 caracteres.',
    ];
    

    public function mount($contratacionId)
    {
        // Asignar el ID de la contratación recibido al componente
        $this->contratacionId = $contratacionId;
        
        $this->contratacion = Contratacion::findOrFail($contratacionId);
        $this->empresas = Auth::user()->empresas->toArray();
        $this->empresa = $this->contratacion->empresa_id;

        //dd($this->empresas);
        //$this->empresa_id = Auth::user()->empresas->first()->id; // Obtiene el ID de la empresa del usuario autenticado
        $this->fec_con = $this->contratacion->fec_con;
        $this->fec_ini = $this->contratacion->fec_ini;
        $this->fec_fin = $this->contratacion->fec_fin;
        $this->hor_dia = $this->contratacion->hor_dia;
        $this->dom_tra = $this->contratacion->dom_tra;
        $this->loc_tra = $this->contratacion->loc_tra;
        $this->pro_tra = $this->contratacion->pro_tra;
        $this->pai_tra = $this->contratacion->pai_tra;
        $this->mon_tot = $this->contratacion->mon_tot;
        $this->des_tra = $this->contratacion->des_tra;

        $this->calcularDiasTrabajo();
        $this->calcularValorHora();
        
    }

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

    public function setMismoDia(){
        $this->fec_fin = $this->fec_ini;
        $this->dias_trabajo = 1;
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

    public function update()
    {
        $this->validate();

        // Crear la contratación
        $this->contratacion->update([
            //'user_id' => Auth::id(),
            'empresa_id' => $this->empresa,
            'fec_con' => $this->fec_con,
            'fec_ini' => $this->fec_ini,
            'fec_fin' => $this->fec_fin,
            'hor_dia' => $this->hor_dia,
            'dom_tra' => $this->dom_tra,
            'loc_tra' => $this->loc_tra,
            'pro_tra' => $this->pro_tra,
            'pai_tra' => $this->pai_tra,
            'mon_tot' => $this->mon_tot,
            'des_tra' => $this->des_tra,
        ]);
//dd($this->modelosSeleccionadas);
        // Asignar los modelos seleccionados a la contratación
        $this->contratacion->modelos()->sync($this->modelos);

        // Redirigir o mostrar un mensaje de éxito
        session()->flash('message', 'Propuesta enviada con éxito.');
        return redirect()->route('empresas.contrataciones.index');
    }


    public function render()
    {
        // Recuperar las modelos asignadas a la contratación
        $modelos = Modelo::whereHas('contrataciones', function($query) {
            $query->where('contratacion_id', $this->contratacionId);
        })->paginate(10);

        // Pasar los modelos a la vista sin asignarlos a una propiedad
        return view('livewire.empresa-contratacion-edit', [
            'modelos' => $modelos
        ]);
    }
}
