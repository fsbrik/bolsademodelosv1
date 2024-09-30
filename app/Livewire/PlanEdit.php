<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pedido;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PlanEdit extends Component
{
    public $user;
    public $selectedPlan;
    public $plan;

    public function mount($planId)
    {
        $this->plan = Pedido::findOrFail($planId);
        
        $this->user = Auth::user();
         
        if($this->user->hasRole('admin'))
        {
            $this->user = $this->plan->user;
        }

        /* $this->pedido = Pedido::where('user_id', $this->user->id)
            ->whereHas('servicios', function ($query) {
                $query->where('sub_cat', 'planes');
            })->first(); */
        //$this->pedido = Pedido::where('id', $planId)->first();
        //dd($planId);

            $this->selectedPlan = $this->plan->servicios()->first()->nom_ser;
    }


    public function selectPlan($plan)
    {
        if(!$this->user)
        {
            return redirect()->route('register');
        }
        else
        {
        
        $servicio = Servicio::where('nom_ser', $plan)->first();


            $this->plan->update([
                'user_id' => $this->user->id,
                'fec_ini' => null,
                'fec_fin' => null,
                'habilita' => null,
                'total' => $servicio->precio,
            ]);


        $this->plan->servicios()->sync([$servicio->id => ['cantidad' => 1]]);

        session()->flash('message', 'seleccionaste el ' . $servicio->nom_ser . '. Solo te falta abonarlo para poder activarlo. Comunicate por teléfono o whatsapp al 11-2155-4283');
        return redirect()->route('planes.index');
        }
    }

    public function render()
    {
        return view('livewire.plan-edit');
    }
}
