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

class EmpresaContratacionEdit extends Component
{
    use WithPagination;

    public $fec_con, $fec_ini, $fec_fin, $hor_dia, $dom_tra, $loc_tra, $pro_tra, $pai_tra, $mon_tot, $des_tra;     
    public $dias_trabajo, $valor_hora; 
    public $empresa, $empresas;
    public $contratacion, $contratacionId;
    public $cant_mod, $modelosSeleccionadas;
    public $planSeleccionado;
    public $confirmaciones;


    protected $rules = [
        'modelosSeleccionadas' => 'required',
        'empresa' => 'required|integer|min:1',
        'cant_mod' => 'required|integer|min:1', 
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
    

    public function mount($contratacionId)
    {
        // Asignar el ID de la contratación recibido al componente
        $this->contratacionId = $contratacionId;

        // Recuperar la contratacion
        $this->contratacion = Contratacion::findOrFail($contratacionId);

        // Recuperar las confirmaciones
        //$this->confirmaciones = Confirmacion::where('contratacion_id', $contratacionId)->get();

        //verifica si ya existe o no una sesion de contratacionEdit
        $this->checkForSessions();
        
        //$this->contratacion = Contratacion::findOrFail($contratacionId); lo introduje en checkForSessions()
        $this->empresas = Auth::user()->empresas->toArray();        

        $this->empresa = session()->get('empresa',$this->contratacion->empresa_id);
        $this->fec_con = session()->get('fec_con',$this->contratacion->fec_con);
        $this->fec_ini = session()->get('fec_ini',$this->contratacion->fec_ini);
        $this->fec_fin = session()->get('fec_fin',$this->contratacion->fec_fin);
        $this->hor_dia = session()->get('hor_dia',$this->contratacion->hor_dia);
        $this->dom_tra = session()->get('dom_tra',$this->contratacion->dom_tra);
        $this->loc_tra = session()->get('loc_tra',$this->contratacion->loc_tra);
        $this->pro_tra = session()->get('pro_tra',$this->contratacion->pro_tra);
        $this->pai_tra = session()->get('pai_tra',$this->contratacion->pai_tra);
        $this->mon_tot = session()->get('mon_tot',$this->contratacion->mon_tot);
        $this->cant_mod = $this->contratacion->cant_mod;//session()->get('cant_mod',$this->contratacion->cant_mod); cant_mod no trabaja con sesiones porque se guarda automaticamente
        $this->des_tra = session()->get('des_tra',$this->contratacion->des_tra);
        $this->calcularDiasTrabajo();
        $this->calcularValorHora();
        
    }

    public function checkForSessions()
    {
        // establecer la sesion de edit
        if(session()->get('contratacion') != 'contratEdit'){
            session()->put('contratacion', 'contratEdit'); 
        }

        // establecer la sesion con el id de la contratacion
        if($this->contratacionId != session()->get('contratacionId')){
            session()->forget(['empresa', 'fec_con', 'fec_ini', 'fec_fin', 'hor_dia',
                 'dom_tra', 'loc_tra', 'pro_tra', 'pai_tra', 'mon_tot', 'des_tra',
                 'modelos_seleccionadas']);
            
            // asigno una variable de sesion nueva de contratacionId
            session()->put('contratacionId', $this->contratacionId);
        }

    }

    /* public function checkForModelos()
    {
        if(session()->has('modelosSeleccionadas'))
        {dd('1');
            $this->modelosSeleccionadas = session()->get('modelosSeleccionadas');
            // ordena el array de las modelos seleccionadas
            asort($this->modelosSeleccionadas, SORT_NATURAL);

        } else {dd('2');
            $this->modelosSeleccionadas = Modelo::whereHas('contrataciones', function($query) {
                $query->where('contratacion_id', $this->contratacionId);});          
        }
        return $this->modelosSeleccionadas;
    } */

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
                if ($this->planSeleccionado->servicios->first()->nom_ser !== 'plan anual' && $this->checkCreditos()) {
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

    public function setMismoDia(){
        $this->fec_fin = $this->fec_ini;
        $this->dias_trabajo = 1;
        session()->put('fec_fin', $this->fec_fin);
    }

    // al actualizar cant_mod, impedir que cant_mod sea menor a las modelos que ya confirmaron
    public function validarMinCantMod()
    {
        $modelosConfirmados = $this->contratacion->confirmaciones->where('estado', 1)->count();
        if($this->cant_mod < $modelosConfirmados)
        {
            $this->cant_mod = $modelosConfirmados;
        }
    }

    // valida la cantidad de modelos a contratar cuando se modifique su valor.
    public function updatedCantMod()
    {
        $this->validarMinCantMod();
        $this->validateOnly('cant_modMaxima');
        $this->validateOnly('cant_mod');
        $this->contratacion->cant_mod = $this->cant_mod;
        $modelosConfirmados = $this->contratacion->confirmaciones->where('estado', 1)->count();
        // en el caso que las modelos que confirmaron coincida con la cantidad de modelos requeridas, la contratación se desactiva
        $this->contratacion->estado = $this->contratacion->cant_mod === $modelosConfirmados ? 0 : 1;
        $this->contratacion->save();
        //session()->put('cant_mod', $this->cant_mod);
    }
    
    public function updatedHorDia()
    {
        $this->calcularValorHora();
        session()->put('hor_dia', $this->hor_dia);
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

    // mostrar el estado de la confirmacion de la modelo. Sirve para habilitar o deshabilitar el boton de "remover" en la vista.
    public function confirmacionEstado($modelo)
    {
        $estado = Confirmacion::where('contratacion_id', $this->contratacionId)->where('modelo_id', $modelo->id)->value('estado');

        // Mapeo de los posibles estados
        $estadoDeConfirmacion = [
            null => 'Pendiente',
            1 => 'Aceptado',
            0 => 'Rechazado'
        ];

        // Retornar el estado correspondiente
        return $estadoDeConfirmacion[$estado] ?? 'Pendiente';
    }

    //eliminar una modelo de la contratacion 
    public function removeModelo($modeloId)
    {
        // Obtén el modelo por su id
        $modelo = Modelo::findOrFail($modeloId);

        // Obtén el array de modelos seleccionados desde la sesión
        $this->modelosSeleccionadas = session()->get('modelos_seleccionadas', []);//dd($this->modelosSeleccionadas);

        // Elimina el mod_id del array
        $this->modelosSeleccionadas = array_diff($this->modelosSeleccionadas, [$modelo->mod_id]);//dd($this->modelosSeleccionadas);

        // ordena el array de las modelos seleccionadas
        asort($this->modelosSeleccionadas, SORT_NATURAL); 

        // Actualiza la sesión con el nuevo array
        session()->put('modelos_seleccionadas', $this->modelosSeleccionadas);
    }

    public function checkCreditos()
    {
        // la cantidad de modelos a contratar inicialmente
        $contratacionInicialCreditos = $this->contratacion->cant_mod;

        // la cantidad de creditos que le quedaban al plan inicialmente incluyendo esta contratacion
        $planInicialCreditos = $this->planSeleccionado->creditos + $contratacionInicialCreditos;

        return $this->cant_mod > $planInicialCreditos ? true : false;
    }

    public function actualizarCreditos()
    {
        // la cantidad de modelos a contratar inicialmente
        $contratacionInicialCreditos = $this->contratacion->cant_mod;
        
        // creditos a agregar o quitar
        $diferenciaCreditos = $contratacionInicialCreditos - $this->cant_mod;

        $this->planSeleccionado->creditos += $diferenciaCreditos;
        $this->planSeleccionado->save();
    }

    // actualiza el estado de modelos que confirmaron la contratacion
    public function obtenerModelosConfirmados($contratacion)
    {
        return $contratacion->confirmaciones->where('estado', 1)->count();
    }

    // si hay al menos una modelo que confirmó, la empresa ya no puede modificar la propuesta de contratación,
    // pero sí puede seguir agregando o quitando modelos en estado "pendiente"
    public function checkConfirmacion($contratacion)
    {
        $modelosConfirmados = $this->obtenerModelosConfirmados($contratacion);
 
        return $modelosConfirmados > 0 ? 'disabled' : '';
    }

    public function update()
    {
        $this->validate();

        // si pasa la validación, le descontamos los créditos de las contratación correspondiente a cant_mod
        $this->actualizarCreditos();

        // Actualizar la propuesta de contratación solo en el caso que no hayan modelos que confirmaron
        if($this->checkConfirmacion($this->contratacion) !== 'disabled')
        {
            $this->contratacion->update([
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
        }
        


        // Obtener los IDs correspondientes a los mod_id seleccionados
        $modelosIds = Modelo::whereIn('mod_id', $this->modelosSeleccionadas)->pluck('id')->toArray();

        // Asignar los modelos seleccionados a la contratación
        $this->contratacion->modelos()->sync($modelosIds); 

        session()->forget(['empresa', 'fec_con', 'fec_ini', 'fec_fin', 'hor_dia',
                 'dom_tra', 'loc_tra', 'pro_tra', 'pai_tra', 'mon_tot', 'cant_mod', 'des_tra',
                 'modelos_seleccionadas', 'contratacion']);

        // Redirigir o mostrar un mensaje de éxito
        session()->flash('message', 'Propuesta reenviada con éxito.');
        return redirect()->route('empresas.contrataciones.index');
    }


    public function render()
    {
        // para poder contratar modelos, se debe chequear que tiene un plan habilitado   
        $this->checkPlan();

        // si alguna modelo confirmó, se deshabilita la edición de la sección de la propuesta
        // $deshabilitar = $this->checkConfirmacion($this->contratacion);

        //verifica si ya existe o no una sesion con modelos
        if(session()->has('modelos_seleccionadas')){
            $this->modelosSeleccionadas = session()->get('modelos_seleccionadas',[]);//dd( $this->modelosSeleccionadas);
            $modelos = Modelo::whereIn('mod_id',$this->modelosSeleccionadas)
                        ->orderByRaw('CAST(SUBSTRING(mod_id, 4) AS UNSIGNED) ASC')->paginate(9);//dd($modelos);
        } else {
            $modelos = $this->contratacion->modelos()
                        ->orderByRaw('CAST(REGEXP_REPLACE(mod_id, "[^0-9]", "") AS UNSIGNED) ASC')->paginate(9);
            $this->modelosSeleccionadas = $this->contratacion->modelos()->pluck('mod_id')->toArray();
            session()->put('modelos_seleccionadas', $this->modelosSeleccionadas);
        }
        
        
        
        //$modelos = Modelo::whereIn('mod_id', $this->modelosSeleccionadas)->orderByRaw('CAST(SUBSTRING(mod_id, 4) AS UNSIGNED) ASC')->paginate(10);

        // Pasar los modelos a la vista sin asignarlos a una propiedad
        return view('livewire.empresa-contratacion-edit', compact('modelos'));

    }
}
