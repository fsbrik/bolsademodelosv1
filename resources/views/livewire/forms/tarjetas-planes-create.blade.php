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

    // en caso que el usuario sea admin, se va a ejecutar este método
    #[On('usuarioSeleccionado')]
    public function asignarIdUsuario($userId)
    {
        $this->plan->userId = $userId; // pasa el valor del usuario seleccionado por el componente seleccionador-de-usuario-en-planes por el admin
    }

    public function store()
    {
        // en caso que el usuario sea empresa se le asigna el id del usuario
        if (Auth::user()->hasRole('empresa')) {
            $this->plan->userId = Auth::user()->id;
        }

        // comprobar si ya posee un plan (activo o sin abonar) y si es asi, hay que impedirle que se cree uno nuevo
        $planPreexistente = Pedido::where('user_id', $this->plan->userId)->whereHas('servicios', fn($query) => 
                                    $query->where('cat_ser', 'empresa')->where('sub_cat', 'planes'))
                                          ->where(function ($q) {
                                            $q->where('habilita', 1)->orWhereNull('habilita');})->first();
                                            
        // si se encuentra un plan preexistente, no va a pasar la validacion en $this->validate()                                    
        $this->plan->planPreexistente = $planPreexistente !== null;
        
        $this->validate();

        $servicio = Servicio::where('nom_ser', $this->plan->planSeleccionado)->first(); // obtiene el plan seleccionado de la tabla servicios

        $plan = Pedido::create([
            'user_id' => $this->plan->userId,
            'total' => $servicio->precio,
        ]);

        // sincronizamos el plan contratado en la relacion pedido_servicio para indicarle el id del servicio
        $plan->servicios()->sync([$servicio->id => ['cantidad' => 1]]);

        return redirect()->route('planes.index', compact('plan'))->with('success', 'seleccionaste el ' . $servicio->nom_ser . '. Solo te falta abonarlo para poder activarlo. Comunicate por teléfono o whatsapp al 11-2155-4283');
    }
}; ?>

<section class="flex flex-col items-center">
    <section id="tarjetas" class="flex flex-col md:w-full md:flex-row md:justify-center md:space-x-3">
        <!-- Plan Simple -->
        <div
            class="flex flex-col basis-full md:basis-1/4 bg-purple-300
            rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 mb-5">
            <div class="flex flex-col flex-grow mx-auto">
                <h3 class="text-gray-600 text-lg">Plan Simple</h3>
                <p class="text-gray-600 mt-1"><span class="font-bold text-black text-4xl">$50.000</span> /u.</p>
                <p class="text-sm text-gray-600 mt-2">Ideal para contrataciones eventuales</p>
                <div class="flex-grow text-sm text-gray-600 mt-4">
                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Incluye 1 contacto efectivo*
                    </p>
                    <p class="my-2 text-xs">*contacto que haya confirmado el trabajo</p>
                </div>
            </div>
            

            <label class="block w-full cursor-pointer mt-2">
                <input type="radio" value="plan simple" wire:model="plan.planSeleccionado" wire:click="store" class="hidden peer">
                <div class="peer-checked:bg-purple-700 peer-checked:text-white text-base
                            bg-white text-purple-700 rounded transition duration-150 ease-in-out py-4 text-center">
                    {{ __('Plan simple') }}
                </div>
            </label>
        </div>

        <!-- Plan Mensual -->
        <div
            class="flex flex-col basis-full md:basis-1/4 bg-purple-300
            rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 mb-5">
            <div class="flex flex-col flex-grow mx-auto">
                <h3 class="text-gray-600 text-lg">Plan mensual</h3>
                <p class="text-gray-600 mt-1"><span class="font-bold text-black text-4xl">$175.000</span> /30
                    días</p>
                <p class="text-sm text-gray-600 mt-2">Ideal para pequeñas empresas</p>
                <p class="text-sm text-gray-600">Ideal por cambio de temporada</p>
                <div class="text-sm text-gray-600 mt-4">
                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Incluye hasta 5 contactos
                        efectivos*</p>
                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Duración: 30 días</p>
                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Ahorro: 30%*</p>
                    <p class="my-2 fa-xs">*comparado con 5 planes simples</p>
                </div>
            </div>
            <label class="block w-full cursor-pointer mt-2">
                <input type="radio" value="plan mensual" wire:model="plan.planSeleccionado" wire:click="store" class="hidden peer">
                <div class="peer-checked:bg-purple-700 peer-checked:text-white text-base
                            bg-white text-purple-700 rounded transition duration-150 ease-in-out py-4 text-center">
                    {{ __('Plan mensual') }}
                </div>
            </label>
        </div>

        <!-- Plan Anual (Full) -->
        <div
            class="flex flex-col basis-full md:basis-1/4 bg-purple-300
            rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 mb-5">
            <div class="flex flex-col flex-grow mx-auto">
                <h3 class="text-gray-600 text-lg">Plan anual (full)</h3>
                <p class="text-gray-600 mt-1"><span class="font-bold text-black text-4xl">$1.470.000</span> /365
                    días</p>
                <p class="text-sm text-gray-600 mt-2">Ideal para grandes empresas</p>
                <p class="text-sm text-gray-600">Ideal para alta demanda de personal</p>
                <div class="text-sm text-gray-600 mt-4">
                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Incluye contactos ilimitados
                    </p>
                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Duración: 365 días</p>
                    <p class="my-2"><span class="fa fa-check-circle mr-2 ml-1"></span>Ahorro: 30%*</p>
                    <p class="my-2 fa-xs">*comparado con 12 planes mensuales</p>
                </div>
            </div>
            <label class="block w-full cursor-pointer mt-2">
                <input type="radio" value="plan anual" wire:model="plan.planSeleccionado" wire:click="store" class="hidden peer">
                <div class="peer-checked:bg-purple-700 peer-checked:text-white text-base
                            bg-white text-purple-700 rounded transition duration-150 ease-in-out py-4 text-center">
                    {{ __('Plan anual') }}
                </div>
            </label>
        </div>
    </section>
    
    <div class="buttons-container mt-4">

        <x-validation-errors></x-validation-errors>
        @can('planes.index')
            <x-cards.button-a route="planes.index">{{ __('Volver') }}</x-cards.button-a>
        @endcan
    </div>
</section>
