<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pedido;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PlanCreate extends Component
{
    public $user;
    public $selectedPlan;
    public $selectedUser = null;
    public $pedido;

    protected $listeners = ['userSelected' => 'updateUser'];
    protected $rules = [
        'selectedUser' => 'required',
    ];
    protected $messages = [
        'selectedUser.required' => 'Debe seleccionarse un usuario',
    ];

    public function mount()
    {        
        if(Auth::user()->hasRole('empresa'))
        {
            $this->user = Auth::user();
        
            $plan = Pedido::where('user_id', $this->user->id)
                ->whereHas('servicios', function ($query) {
                    $query->where('cat_ser', 'empresa')
                    ->where('sub_cat', 'planes');
                })->where(function($query) {
                    $query->where('habilita', '<>', 0)
                          ->orWhereNull('habilita');
                })->orderBy('created_at', 'desc')->first();
            
            if ($plan) {
                return redirect()->route('planes.index');
            }
        }
    }

    public function updateUser(User $user)
    {
        // obtener el rol del usuario
        $userRole = $user->roles->first()->name;

        if($userRole == 'empresa'){
            // $this->selectedUser se usa para mostrar el alert con el user seleccionado
            $this->selectedUser = $user;
            // $this->user se va a usar para hacer el update en selectPlan
            $this->user = $user;
            // actualizar el estado del ultimo plan contratado por $this->selectedUser
            $this->actualizarEstadoUltimoPlanContratado();
            // permite o no la contratacion de un plan por parte de $this->selectedUser
            $this->permitirContratacionPlan();
        } 
        elseif($userRole == 'modelo'){
            session()->flash('selectedUserError', 'seleccionaste una modelo en vez de un usuario de rol empresa');
            //return view('livewire.plan-create');
        }
    }

    public function selectPlan($plan)
    {
        if(Auth::user()->hasRole('admin') && !$this->selectedUser)
        {
            session()->flash('selectedUserError', 'Falta seleccionar un user del tipo empresa');
            return redirect()->route('planes.create');
        }

        if(!$this->user)
        {
            return redirect()->route('register');
        }
        else
        {

        $servicio = Servicio::where('nom_ser', $plan)->first();

        $plan = Pedido::create([
            'user_id' => $this->user->id,
            'total' => $servicio->precio
        ]);


        $plan->servicios()->sync([$servicio->id => ['cantidad' => 1]]);

        session()->flash('message', 'seleccionaste el ' . $servicio->nom_ser . '. Solo te falta abonarlo para poder activarlo. Comunicate por teléfono o whatsapp al 11-2155-4283');
        return redirect()->route('planes.index', compact('plan'));
        }
    }

    public function actualizarEstadoUltimoPlanContratado()
    {
        // obtener el ultimo plan contratado
        $ultimoPlanContratado = Pedido::where('user_id', $this->user->id)
                        ->where('habilita', 1)
                        ->whereHas('servicios', function ($query) {
                                $query->where('sub_cat', 'planes');
                        })->orderBy('created_at', 'desc')->first();

        // si se verifica que hay un plan habilitado, verificamos para saber si hay que actualizar el estado o no
        if($ultimoPlanContratado)
        {
            // obtener el nombre del plan
            $nombrePlan = $ultimoPlanContratado->servicios()->where('pedido_id', $ultimoPlanContratado->id)->first()->nom_ser;

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
            //dd('nombrePlan: '.$nombrePlan.' fecfin: '.$comprobarFec_fin.' creditos: '.$comprobarCreditos);
            // si se le terminaron los creditos o se vencio el plan
            if ($comprobarFec_fin === false || $comprobarCreditos === false)
            {
                $ultimoPlanContratado->update([
                    'habilita' => 0
                ]);
            }

        }
        



    }

    public function permitirContratacionPlan()
    {

        // obtener el ultimo plan contratado
        $comprobarPlan = Pedido::where('user_id', $this->user->id)
                        ->where('habilita', 1)
                        ->whereHas('servicios', function ($query) {
                                $query->where('sub_cat', 'planes');
                        })->orderBy('created_at', 'desc')->first();

        // comprueba cualquiera sea el plan seleccionado, si esta habilitado o no
        if($comprobarPlan)
        {
            session()->flash('selectedUserError', 'El usuario '.$this->selectedUser->name.' ya tiene un plan activo');
            return redirect()->route('planes.index');
        }

        // si se verifica que hay un plan habilitado, no hace falta comprobar el resto.
        

        
        
        //dd('nombre plan: '.$nombrePlan.' habilitado: '.$comprobarHabilitacion.' fec_fin: '.$comprobarFec_fin.' creditos: '.$comprobarCreditos);
        
        

        
    }

    public function render()
    {
        
            return view('livewire.plan-create');

        
    }
}
