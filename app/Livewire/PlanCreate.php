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
                    $query->where('sub_cat', 'planes');
                })->first();
            
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

    public function render()
    {
        
            return view('livewire.plan-create');

        
    }
}
