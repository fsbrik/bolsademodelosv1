<?php

use App\Livewire\Forms\PlanForm;
use Livewire\Volt\Component;
use App\Models\Pedido;
use App\Models\User;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

new class extends Component {
    public PlanForm $plan;
    public Pedido $planOriginal;
    public $planSeleccionado;

    public function mount($planId)
    {
        $this->planOriginal = Pedido::findOrFail($planId);
        $nom_serSeleccionado = $this->planOriginal->servicios()->where('pedido_id', $this->planOriginal->id)->first()->nom_ser;
        $this->plan->fill([
            'planSeleccionado' => $nom_serSeleccionado,
            'userId' => $this->planOriginal->user_id
        ]);
    }

    /* #[On('idUsuarioSeleccionado')]
    public function asignarIdUsuario($idUsuarioSeleccionado)
    {
        $this->userId = $idUsuarioSeleccionado; // pasa el valor del usuario seleccionado por el componente seleccionador-de-usuario por el admin
    } */

    // este método asigna el id del usuario autenticado (es decir que no es el admin)
    /* public function verificarIdUsuarioEmpresa()
    {
        if (Auth::user()->hasRole('empresa')) {
            $this->userId = Auth::user()->id;
        }
    } */
    
    public function update()
    {   
        //$this->plan->planSeleccionado = $nombrePlanSeleccionado; // cargamos el valor pasado por parametro en el PlanForm para validarlo
        
        $this->validate();

        $planSeleccionado = Servicio::where('nom_ser', $this->plan->planSeleccionado)->first(); // obtiene el plan seleccionado de la tabla servicios

        $this->planOriginal->update(['total' => $planSeleccionado->precio]);   

        // sincronizamos el plan contratado en la relacion pedido_servicio para indicarle el id del servicio
        $this->planOriginal->servicios()->sync([$planSeleccionado->id => ['cantidad' => 1]]);
        //dd($this->planOriginal);
        $this->dispatch('mostrar-alerta', tipo: 'success', mensaje: 'Se modificó el plan a ' . $planSeleccionado->nom_ser);
        
        //return redirect()->route('planes.index', compact('plan'))->with('success', 'seleccionaste el ' . $servicio->nom_ser . '. Solo te falta abonarlo para poder activarlo. Comunicate por teléfono o whatsapp al 11-2155-4283');
    }
}; ?>
<section class="flex flex-col items-center">
    <section id="tarjetas" class="flex flex-col md:w-full md:flex-row md:justify-center md:space-x-3">

        <!-- Plan Simple -->
        <x-cards.card-plan-update
            titulo="Plan simple"
            precio="50.000"
            duracion="/u."
            descripcion-corta="Ideal para contrataciones eventuales"
            :descripcion-larga="[
                'Incluye 1 contacto efectivo*',
                '*contacto que haya confirmado el trabajo'
            ]"
            value="plan simple"
            :plan-seleccionado="$plan->planSeleccionado"
        />

        <!-- Plan Mensual -->
        <x-cards.card-plan-update
            titulo="Plan mensual"
            precio="175.000"
            duracion="30 días"
            descripcion-corta="Ideal para pequeñas empresas"
            :descripcion-larga="[
                'Incluye hasta 5 contactos efectivos*',
                'Duración: 30 días',
                'Ahorro: 30%*',
                '*comparado con 5 planes simples'
            ]"
            value="plan mensual"
            :plan-seleccionado="$plan->planSeleccionado"
        />

        <!-- Plan Anual (Full) -->
        <x-cards.card-plan-update
            titulo="Plan anual (full)"
            precio="1.470.000"
            duracion="365 días"
            descripcion-corta="Ideal para grandes empresas"
            :descripcion-larga="[
                'Incluye contactos ilimitados',
                'Duración: 365 días',
                'Ahorro: 30%*',
                '*comparado con 12 planes mensuales'
            ]"
            value="plan anual"
            :plan-seleccionado="$plan->planSeleccionado"
        />

    </section>
    
    <div class="buttons-container mt-4">

        <x-validation-errors></x-validation-errors>
        @can('planes.index')
            <x-cards.button-a route="planes.index">{{ __('Volver') }}</x-cards.button-a>
        @endcan
    </div>
</section>
