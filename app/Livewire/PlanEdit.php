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
        $this->plan = Pedido::with('servicios')->findOrFail($planId);
        $this->user = $this->userIsAdmin() ? $this->plan->user : Auth::user();
        $this->selectedPlan = $this->plan->servicios->first()->nom_ser ?? 'N/A';
    }

    private function userIsAdmin()
    {
        return Auth::user()->hasRole('admin');
    }

    private function getServicioByName($plan)
    {
        return Servicio::where('nom_ser', $plan)->first();
    }

    public function selectPlan($plan)
    {
        if (!$this->user) {
            return redirect()->route('register');
        }

        $servicio = $this->getServicioByName($plan);

        if (!$servicio) {
            session()->flash('error', 'El plan seleccionado no existe.');
            return back();
        }

        $this->plan->update([
            'user_id' => $this->user->id,
            'fec_ini' => null,
            'fec_fin' => null,
            'creditos' => null,
            'habilita' => null,
            'total' => $servicio->precio,
        ]);

        $this->plan->servicios()->sync([$servicio->id => ['cantidad' => 1]]);

        session()->flash('message', 'Seleccionaste el ' . $servicio->nom_ser . '. Solo te falta abonarlo para poder activarlo. Comunicate por teléfono o WhatsApp al 11-2155-4283');
        return redirect()->route('planes.index');
    }

    public function render()
    {
        return view('livewire.plan-edit');
    }
}
