<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pedido;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class Plan extends Component
{
    public $user;
    public $selectedPlan;
    public $pedido;

    public function mount()
    {
        $this->user = Auth::user();
        $this->pedido = Pedido::where('user_id', $this->user->id)
            ->whereHas('servicios', function ($query) {
                $query->where('sub_cat', 'contrataciones');
            })->first();
        //dd($pedido);
        if ($this->pedido) {
            $this->selectedPlan = $this->pedido->servicios()->first()->nom_ser;
        }
    }

    public function selectPlan($plan)
    {
        $servicio = Servicio::where('nom_ser', $plan)->first();

        if ($this->pedido) {
            $this->pedido->update([
                'user_id' => $this->user->id,
                'fecha' => Carbon::now()->format('Y-m-d'),
                'total' => $servicio->precio
            ]);
        } else {
            $this->pedido = Pedido::create([
                'user_id' => $this->user->id,
                'fecha' => Carbon::now()->format('Y-m-d'),
                'total' => $servicio->precio
            ]);
        }

        $this->pedido->servicios()->sync([$servicio->id => ['cantidad' => 1]]);

        session()->flash('message', 'seleccionaste el ' . $servicio->nom_ser . '. Solo te falta abonarlo para poder activarlo.');
        return redirect()->route('empresas.planes');
    }

    public function render()
    {
        return view('livewire.plan');
    }
}
