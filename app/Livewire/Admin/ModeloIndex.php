<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Modelo;
use App\Models\Pedido;
use App\Models\Confirmacion;
use Illuminate\Support\Facades\Auth;

class ModeloIndex extends Component
{
    public $user;
    public $searchModId, $searchName, $searchTelefono, $searchEmail;
    public $searchEdadMin, $searchEdadMax, $searchSexo, $searchEstaturaMin, $searchEstaturaMax;
    public $searchZonRes, $searchDisVia, $searchTitMod, $searchIngles, $searchDisTra, $searchCabello;
    public $searchTarMedMin, $searchTarMedMax, $searchTarComMin, $searchTarComMax;
    public $searchEstado, $searchHabilita;
    public $localidades = [];
    public $sort_By = null, $sortDirection = 'asc';
    public $showTable = true;
    public $modelosSeleccionadas = [];
    public $creditos;
    // variables para mostrar con el mensaje de las modelos seleccionadas
    public $seleccionMessage, $strModelo;
    // saber de que pagina proviene, de create o de edit
    public $action = null;
    // si proviene de edit, necesito recuperar el valor de sesion de contratacionId
    public $contratacionId;

    use WithPagination;

    public function mount(){

        $this->localidades = include(public_path('storage/localidades/localidades.php'));
        
        // verificar las sesiones, si va a crear o editar una contratacion
        $this->checkForSessions();

        // verifica si la empresa tiene contratado un plan (en el caso que el usuario sea registrado como empresa)
        (Auth::user() && Auth::user()->hasRole('empresa')) ? $this->checkPlan() : '';

        // actualiza el estado de modelos seleccionadas (que pueden provenir de la pagina create o edit)
        $this->checkModelosSeleccionadas();        
    }

    public function checkPlan()
    {
        $this->user = Auth::user();

        $plan = Pedido::where('user_id', $this->user->id)
                       ->whereHas('servicios', function ($query) {
                            $query->where('sub_cat', 'planes');
                        })->first();

        $plan_seleccionado = $plan ? $plan->servicios->first()->nom_ser : null ;
        
        if($plan_seleccionado === null)
        {
            $this->creditos = 0;
        }
        elseif($plan_seleccionado == 'plan simple')
        {
            $this->creditos = 1;
        } 
        elseif($plan_seleccionado == 'plan mensual')
        {
            $this->creditos = 5;
            //$this->fec_fin = 
        }
        elseif($plan_seleccionado == 'plan anual')
        {
            $this->creditos = 100;
        }

    }

    public function checkForSessions()
    {
        if (session()->get('contratacion') == 'contratCreate'){
            $this->action = 'contratCreate';
        } elseif (session()->get('contratacion') == 'contratEdit'){
            $this->action = 'contratEdit';
            // actualizo contratacionId
            $this->contratacionId = session()->get('contratacionId');
        } elseif (session()->get('contratacion') === null){
            $this->action = 'contratCreate';
        }
    }
    


    public function checkModelosSeleccionadas()
    {
        // mostrar las modelos seleccionadas en el alert
        $this->modelosSeleccionadas = session()->get('modelos_seleccionadas', []);
        //muestra el mensaje inicial dependiendo si es una o varias modelos seleccionadas

        if(count($this->modelosSeleccionadas) > 0)
        {
            $this->mostrarMensajeInicialAlert();
        }
    }


    /* mensaje en el alert de las modelos seleccionadas dependiendo la cantidad de modelos */
    public function mostrarMensajeInicialAlert()
    {
        if(count($this->modelosSeleccionadas) > 1){
            $this->seleccionMessage = 'Seleccionaste a las modelos '; 
        } else {
            $this->seleccionMessage = 'Seleccionaste a la modelo ';
        }
    }

    /* agregar por valores de sesion a modelos seleccionadas */
    public function selectModelo($modeloId)
    {
        // Obtén el modelo por su id
        $modelo = Modelo::findOrFail($modeloId);

        // Obtén los modelos seleccionados desde la sesión
        //$this->modelosSeleccionadas = session()->get('modelos_seleccionadas', []);

        // Verifica si el mod_id no está ya en el array
        if (!in_array($modelo->mod_id, $this->modelosSeleccionadas)) {
            // Agrega el mod_id al array
            $this->modelosSeleccionadas[] = $modelo->mod_id;
        }
        
        // ordena el array de las modelos
        asort($this->modelosSeleccionadas, SORT_NATURAL);
        
        // Actualiza la sesión con el nuevo array
        //session()->put('modelos_seleccionadas', $this->modelosSeleccionadas);

        //muestra el mensaje inicial dependiendo si es una o varias modelos seleccionadas
        $this->mostrarMensajeInicialAlert();       

        //return redirect()->route('empresas.contrataciones.create')->with('message', 'Seleccionaste a la modelo '.$modelo->mod_id);
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

    public function removeModelo($modeloId)
    {
        // Obtén el modelo por su id
        $modelo = Modelo::findOrFail($modeloId);

        // Obtén el array de modelos seleccionados desde la sesión
        //$this->modelosSeleccionadas = session()->get('modelos_seleccionadas', []);

        // Elimina el mod_id del array
        $this->modelosSeleccionadas = array_diff($this->modelosSeleccionadas, [$modelo->mod_id]);

        // ordena el array de las modelos seleccionadas
        asort($this->modelosSeleccionadas, SORT_NATURAL);

        // Actualiza la sesión con el nuevo array
        //session()->put('modelos_seleccionadas', $this->modelosSeleccionadas);

       //muestra el mensaje inicial dependiendo si es una o varias modelos seleccionadas
       $this->mostrarMensajeInicialAlert();
    }

    public function addModelosSeleccionadas()
    {
        // Actualiza la sesión con el nuevo array
        session()->put('modelos_seleccionadas', $this->modelosSeleccionadas);

        if($this->action == 'contratCreate'){            
            return redirect()->route('empresas.contrataciones.create');
        } 
        elseif($this->action == 'contratEdit'){
            return redirect()->route('empresas.contrataciones.edit', $this->contratacionId);
        }
    }

    public function updating($field)
    {
        if (in_array($field, [
            'searchModId', 'searchName', 'searchTelefono', 'searchEmail',
            'searchEdadMin', 'searchEdadMax', 'searchSexo', 'searchEstaturaMin', 'searchEstaturaMax',
            'searchCabello', 'searchZonRes', 'searchDisVia', 'searchTitMod', 'searchIngles', 'searchDisTra',
            'searchTarMedMin', 'searchTarMedMax', 'searchTarComMin', 'searchTarComMax',
            'searchEstado', 'searchHabilita'
        ])) {
            $this->resetPage();
        }
    }

    public function sortBy($field)
    {
        if ($this->sort_By === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort_By = $field;
            $this->sortDirection = 'asc';
        }
        //$this->sort_By = $field;
    }

    public function destroy(Modelo $modelo){
        $modelo->delete();
        session()->flash('message', '¡Se eliminó la ficha de la modelo '.$modelo->user->name.' exitosamente!');
        $modelos = Modelo::paginate(10);
        $localidades = $this->localidades;

        return view('livewire.admin.modelo-index', compact('modelos', 'localidades'));
    }

    public function render()
    {
        $modelos = Modelo::query();

        if ($this->searchModId) {
            $modelos->where('mod_id', 'like', '%' . $this->searchModId . '%');
        }

        if ($this->searchName || $this->searchTelefono || $this->searchEmail) {
            $modelos->whereHas('user', function ($query) {
                if ($this->searchName) {
                    $query->where('name', 'like', '%' . $this->searchName . '%');
                }
                if ($this->searchTelefono) {
                    $query->where('telefono', 'like', '%' . $this->searchTelefono . '%');
                }
                if ($this->searchEmail) {
                    $query->where('email', 'like', '%' . $this->searchEmail . '%');
                }
            });
        }

        if ($this->searchEdadMin || $this->searchEdadMax) {
            $minAge = $this->searchEdadMin ?? 0;
            $maxAge = $this->searchEdadMax ?? 150; // Un valor alto por defecto para el límite máximo de edad
            $modelos->whereRaw('TIMESTAMPDIFF(YEAR, fec_nac, CURDATE()) BETWEEN ? AND ?', [$minAge, $maxAge]);
        }
        

        if ($this->searchSexo) {
            $modelos->where('sexo', 'like', '%' . $this->searchSexo . '%');
        }

        if ($this->searchEstaturaMin || $this->searchEstaturaMax) {
            $modelos->whereBetween('estatura', [$this->searchEstaturaMin, $this->searchEstaturaMax]);
        }

        if ($this->searchCabello) {
            $modelos->where('col_cab', 'like', '%' . $this->searchCabello . '%');
        }

        if ($this->searchZonRes) {
            $modelos->where('zon_res', 'like', '%' . $this->searchZonRes . '%');
        }

        if (!is_null($this->searchDisVia)) {
            $modelos->where('dis_via', 'like', '%' . $this->searchDisVia . '%');
        }

        if (!is_null($this->searchTitMod)) {
            $modelos->where('tit_mod', 'like', '%' . $this->searchTitMod . '%');
        }

        if ($this->searchIngles) {
            $modelos->where('ingles', 'like', '%' . $this->searchIngles . '%');
        }

        if ($this->searchDisTra) {
            $modelos->where('dis_tra', 'like', '%' . $this->searchDisTra . '%');
        }

        if ($this->searchTarMedMin || $this->searchTarMedMax) {
            $modelos->whereBetween('tar_med', [$this->searchTarMedMin, $this->searchTarMedMax]);
        }

        if ($this->searchTarComMin || $this->searchTarComMax) {
            $modelos->whereBetween('tar_com', [$this->searchTarComMin, $this->searchTarComMax]);
        }

        if ($this->sort_By) {
            $modelos->orderBy($this->sort_By, $this->sortDirection);
        }

        if (!is_null($this->searchEstado)) {
            $modelos->where('estado', 'like', '%' . $this->searchEstado . '%');
        }

        if (!is_null($this->searchHabilita)) {
            $modelos->where('habilita', 'like', '%' . $this->searchHabilita . '%');
        }

        $modelos = $modelos->paginate(10);
        $localidades = $this->localidades;

        return view('livewire.admin.modelo-index', compact('modelos', 'localidades'));
    }
}
