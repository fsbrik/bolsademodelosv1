<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Modelo;
use App\Models\Contratacion;
use App\Models\Pedido;
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
        $this->checkCreateOrEdit();
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

    // actualiza el estado de modelos que confirmaron la contratacion
    public function obtenerModelosConfirmados($contratacion)
    {
        return $contratacion->confirmaciones->where('estado', 1)->count();
    }

    // permite eliminar o no una contratacion dependiendo si tiene o no modelos que confirmaron
    // tambien verifica que la fecha actual sea anterior a la fecha de inicio de la contratacion
    public function checkConfirmacion($contratacion)
    {
        $esAnteriorAFecIni = Carbon::now()->lt(Carbon::parse($contratacion->fec_ini));
        $modelosConfirmados = $this->obtenerModelosConfirmados($contratacion);

        // Si la fecha actual es anterior a fec_ini y no hay modelos confirmados
        return $esAnteriorAFecIni && $modelosConfirmados === 0;
    }

    // actualiza el estado del plan contratado (en caso de tener uno). Podria haberlo denominado como updateHabilitacion.
    public function actualizarEstadoUltimoPlanContratado()
    {
        $user = Auth::user();
        // obtener el ultimo plan contratado
        $ultimoPlanContratado = Pedido::whereHas('servicios', function ($query) {
            $query->where('sub_cat', 'planes');
            })->where('user_id', $user->id)->where('habilita', 1)->orderBy('created_at', 'desc')->first();
        
        
        // si el plan contratado no es null, lo actualizo
        if($ultimoPlanContratado)
        {
            // obtener el nombre del plan
            $nombrePlan = $ultimoPlanContratado->servicios->first()->nom_ser;

            //dependiendo del plan seleccionado se le da un tratamiento distinto
            switch ($nombrePlan)
            {
                case 'plan simple':
                    // el plan simple no tiene fec_fin, por lo tanto no se comprueba, por ende siempre va a ser true
                    $comprobarFec_fin = true;
                    //comprobamos si se quedo sin creditos
                    $comprobarCreditos = $ultimoPlanContratado->creditos > 0 ? true : false;
                    break;
                
                case 'plan mensual':
                    // comprobamos que no se haya vencido el fec_fin
                    $comprobarFec_fin = Carbon::now()->lt(Carbon::parse($ultimoPlanContratado->fec_fin)) ? true : false;
                    //comprobamos si se quedo sin creditos
                    $comprobarCreditos = $ultimoPlanContratado->creditos > 0 ? true : false;
                    break;
                
                case 'plan anual':
                    // comprobamos que no se haya vencido el fec_fin
                    $comprobarFec_fin = Carbon::now()->lt(Carbon::parse($ultimoPlanContratado->fec_fin)) ? true : false;
                    // el plan anual tiene creditos infinitos, por lo tanto no se comprueba, por ende siempre va a ser true
                    $comprobarCreditos = true;
                    break;
            }

            // si se le terminaron los creditos o se vencio el plan
            if ($comprobarFec_fin === false || $comprobarCreditos === false)
            {
                $ultimoPlanContratado->update([
                    'habilita' => 0
                ]);
            }
        }
    }

    // permite crear una contratacion, editar y eliminar dependiendo el plan que tenga contratado
    // en caso de no tener un plan contratado, no podra hacer ninguna de estas acciones
    public function checkHabilitacion()
    {
        $user = Auth::user();
        $planContratado = Pedido::whereHas('servicios', function ($query) {
            $query->where('sub_cat', 'planes');
            })->where('user_id', $user->id)->where('habilita', 1)->first();
        return $planContratado ? true : false;        
    }

    // actualizar el estado de las contrataciones
    public function updateEstadoContratacion($contrataciones)
    {
        $contrataciones->each(function($contratacion){
            if(Carbon::now()->gt(Carbon::parse($contratacion->fec_fin)))
            {
                $contratacion->update([
                    'estado' => 0
                ]);
            }
        });
    }

    // permite editar o eliminar una contratacion dependiendo si la fec_fin esta vencida.
    public function checkEstadoContratacion(Contratacion $contratacion)
    {
        return $contratacion->estado;
    }

    public function checkCreateOrEdit()
    {
        if (session()->get('contratacion') == 'contratCreate'){
            $this->action = 'contratCreate';
        } elseif (session()->get('contratacion') == 'contratEdit'){
            $this->action = 'contratEdit';
            $this->contratacionId = session()->get('contratacionId');
        } elseif (session()->get('contratacion') === null){
            $this->action = 'contratCreateNew';
        }
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
        
        // actualizar el estado de cada contratacion    
        $this->updateEstadoContratacion($contrataciones);

        // actualizar el estado del plan
        $this->actualizarEstadoUltimoPlanContratado();      

        return view('livewire.empresa-contratacion-index', compact('contrataciones'));
    }
}
