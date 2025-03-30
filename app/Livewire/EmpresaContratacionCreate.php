<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Modelo;
use App\Models\Contratacion;
use App\Models\Confirmacion;
use App\Models\Pedido;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

use Faker\Factory as Faker;

class EmpresaContratacionCreate extends Component
{
    use WithPagination;

    public $fec_con, $fec_ini, $fec_fin, $hor_dia, $dom_tra, $loc_tra, $pro_tra, $pai_tra, $mon_tot, $des_tra;     
    public $dias_trabajo, $valor_hora; 
    public $empresa, $empresas;
    public $cant_mod, $modelosSeleccionadas;
    public $planSeleccionado;


    protected $rules = [
        'modelosSeleccionadas' => 'required',
        'cant_mod' => 'required|integer|min:1',
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
        'modelosSeleccionadas.required' => 'Debe seleccionar al menos 1 modelo',

        'cant_mod.required' => 'Debe indicar una cantidad.',
        'cant_mod.integer' => 'La cantidad debe ser un valor numérico.',
        'cant_mod.min' => 'La cantidad debe ser mayor a cero.',

        'empresa.required' => 'Debe seleccionar una empresa.',
        'empresa.integer' => 'Debe seleccionar una empresa.',
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

    public function mount()
    {
        //verifica si ya existe o no una sesion de contratacionCreate
        $this->checkForSessions();        
        //$this->checkPlan(); esta repetido en el render. Ver en donde conviene ponerlo
        
        $faker = Faker::create();
        $this->empresas = Auth::user()->empresas->toArray();
        $this->empresa = session()->get('empresa');
        $this->fec_con = session()->get('fec_con', Carbon::now()->format('Y-m-d'));  // Fecha actual;       
        $this->fec_ini = session()->get('fec_ini', Carbon::now()->addDays(10)->format('Y-m-d'));
        $this->fec_fin = session()->get('fec_fin', $this->fec_ini);
        $this->hor_dia = session()->get('hor_dia', $faker->numberBetween(1, 8));
        $this->dom_tra = session()->get('dom_tra', $faker->streetAddress);
        $this->loc_tra = session()->get('loc_tra', $faker->city);
        $this->pro_tra = session()->get('pro_tra', $faker->state);
        $this->pai_tra = session()->get('pai_tra', $faker->country);
        $this->mon_tot = session()->get('mon_tot', $faker->numberBetween(200, 500));
        $this->cant_mod = session()->get('cant_mod');
        $this->des_tra = session()->get('des_tra', $faker->sentence(8, true));
        $this->calcularDiasTrabajo();
        $this->calcularValorHora();
    }

    public function checkForSessions()
    {
        // establecer la sesion de create
        if(session()->get('contratacion') != 'contratCreate'){
            session()->forget(['empresa', 'fec_con', 'fec_ini', 'fec_fin', 'hor_dia',
                 'dom_tra', 'loc_tra', 'pro_tra', 'pai_tra', 'mon_tot', 'des_tra',
                 'modelos_seleccionadas']);

            session()->put('contratacion', 'contratCreate'); 
        }
    }

    public function checkPlan()
    {
        $userId = Auth::user()->id;
        $this->planSeleccionado = Pedido::where('user_id', $userId)
                                ->whereHas('servicios', function($query){
                                    $query->where('sub_cat', 'planes');
                                })
                                ->where('habilita', 1)->first();
        
        if(!$this->planSeleccionado)
        {
            session()->flash('message', 'Adquirí un plan para empezar a contratar. Comunicate por whatsapp al 11-2155-4283 para habilitarlo');
            return redirect()->route('planes.index');
        }
    }

    // valida la cantidad de modelos a contratar. Compone el mensaje de error.
    public function boot()
    {
        $this->withValidator(function ($validator) {
            $validator->after(function ($validator) {
                if ($this->planSeleccionado->servicios->first()->nom_ser !== 'plan anual' && $this->validarMaxCantMod()) {
                    $validator->errors()->add('cant_modMaxima', 'Cantidad máxima superada');
                }
            });
        });
    }

    public function updatedEmpresa()
    {
        session()->put('empresa', $this->empresa);
    }

    public function updatedFecIni()
    {
        $this->calcularDiasTrabajo();
        $this->calcularValorHora();
        session()->put('fec_ini', $this->fec_ini);
    }

    public function updatedFecFin()
    {
        $this->calcularDiasTrabajo();
        $this->calcularValorHora();
        session()->put('fec_fin', $this->fec_fin);
    }

    public function updatedDomTra()
    {
        session()->put('dom_tra', $this->dom_tra);
    }

    public function updatedLocTra()
    {
        session()->put('loc_tra', $this->loc_tra);
    }

    public function updatedProTra()
    {
        session()->put('pro_tra', $this->pro_tra);
    }

    public function updatedPaiTra()
    {
        session()->put('pai_tra', $this->pai_tra);
    }

    public function updatedMonTot()
    {
        $this->calcularValorHora();
        session()->put('mon_tot', $this->mon_tot);
    }

    public function updatedDesTra()
    {
        session()->put('des_tra', $this->des_tra);
    }

    public function setMismoDia()
    {
        $this->fec_fin = $this->fec_ini;
        $this->dias_trabajo = 1;
        session()->put('fec_fin', $this->fec_fin);
        $this->calcularValorHora();
    }

    public function updatedHorDia()
    {
        $this->calcularValorHora();
        session()->put('hor_dia', $this->hor_dia);
    }

    // al actualizar cant_mod, impedir que cant_mod sea mayor que los créditos restantes
    public function validarMaxCantMod()
    {
        if($this->cant_mod > $this->planSeleccionado->creditos)
        {
            $this->cant_mod = $this->planSeleccionado->creditos;
            return true;
        } else {
            return false;
        }
    }

    // valida la cantidad de modelos a contratar cuando se modifique su valor.
    public function updatedCantMod()
    {
        $this->validateOnly('cant_modMaxima');
        $this->validateOnly('cant_mod');
        session()->put('cant_mod', $this->cant_mod);
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

    //eliminar una modelo de la contratacion 
    public function removeModelo($modeloId)
    {
        // Obtén el modelo por su id
        $modelo = Modelo::findOrFail($modeloId);

        // Obtén el array de modelos seleccionados desde la sesión
        $this->modelosSeleccionadas = session()->get('modelos_seleccionadas', []);

        // Elimina el mod_id del array
        $this->modelosSeleccionadas = array_diff($this->modelosSeleccionadas, [$modelo->mod_id]);

        // ordena el array de las modelos seleccionadas
        asort($this->modelosSeleccionadas, SORT_NATURAL); 

        // Actualiza la sesión con el nuevo array
        session()->put('modelos_seleccionadas', $this->modelosSeleccionadas);
    }

    public function disminuirCreditos()
    {
        $this->planSeleccionado->creditos -= $this->cant_mod;
        $this->planSeleccionado->save();
    }

    public function store()
    {
        $this->validate();

        // si pasa la validación, le descontamos los créditos de las contratación correspondiente a cant_mod
        $this->disminuirCreditos();

        // Crear la contratación
        $contratacion = Contratacion::create([
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
            'cant_mod' => $this->cant_mod,
            'des_tra' => $this->des_tra,
        ]);

        // recupera la coleccion para las modelos seleccionadas
        $modelos = Modelo::whereIn('mod_id', $this->modelosSeleccionadas)->get();

        // crear las confirmaciones
        collect($modelos)->each(function($modelo) use ($contratacion) {
            Confirmacion::create([
                'contratacion_id' => $contratacion->id,
                'modelo_id' => $modelo->id,
                'estado' => null
            ]);
        });

        // Asignar las modelos seleccionados a la contratación
        $contratacion->modelos()->sync($modelos);

        session()->forget(['empresa', 'fec_con', 'fec_ini', 'fec_fin', 'hor_dia',
                 'dom_tra', 'loc_tra', 'pro_tra', 'pai_tra', 'mon_tot', 'cant_mod', 'des_tra',
                 'modelos_seleccionadas', 'contratacion']);

        // Redirigir o mostrar un mensaje de éxito
        return to_route('empresas.contrataciones.index')->with('message', 'Propuesta n° '.$contratacion->id.' enviada con éxito.');
    }


    public function render()
    {        
        // para poder contratar modelos, se debe chequear que tiene un plan habilitado   
        $this->checkPlan();

        $this->modelosSeleccionadas = session()->get('modelos_seleccionadas',[]);
        $modelos = Modelo::whereIn('mod_id', $this->modelosSeleccionadas)->paginate(9);
        
        return view('livewire.empresa-contratacion-create', compact('modelos'));
    }
}
