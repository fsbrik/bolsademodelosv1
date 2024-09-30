<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pedido;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PlanShow extends Component
{
    public $user;
    public $plan, $selectedPlan;

    public function mount($planId)
    {
        $this->plan = Pedido::findOrFail($planId);

        $this->selectedPlan = $this->plan->servicios()->first()->nom_ser;
        //$this->user = Auth::user();
    }

    public function getEstado()
    {
        return $this->plan->habilita == '1' ? 'habilitado' : 'no habilitado';
    }

    public function getInicio()
    {
        return $this->plan->fec_ini;
    }

    public function getVencimiento()
    {
        return $this->plan->fec_fin === null ? '-' : $this->plan->fec_fin;
    }
    /* public function selectPlan($plan)
    {
        if(!$this->user)
        {
            return redirect()->route('register');
        }
        else
        {
        
        $servicio = Servicio::where('nom_ser', $plan)->first();

        $plan = Pedido::create([
            'user_id' => $this->user->id,
            //'empresa_id' => $empresa->id,
            'fec_ini' => Carbon::now()->format('Y-m-d'),
            'total' => $servicio->precio
        ]);


        $plan->servicios()->sync([$servicio->id => ['cantidad' => 1]]);

        session()->flash('message', 'seleccionaste el ' . $servicio->nom_ser . '. Solo te falta abonarlo para poder activarlo. Comunicate por teléfono o whatsapp al 11-2155-4283');
        return redirect()->route('planes.index', compact('plan'));
        }
    } */

    public function render()
    {
        
            return view('livewire.plan-show');

        
    }
}
