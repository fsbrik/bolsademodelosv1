<?php

use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use Illuminate\Support\Carbon;
use App\Traits\Planes\HasComputedPlanes;
use App\Traits\Sorting\HasSorting;
use App\Traits\Searching\HasSearching;
use App\Models\Plan;
use App\Models\Pedido;
use App\Models\Servicio;
use App\Models\Contratacion;
use App\Models\Confirmacion;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

new class extends Component {
    use WithPagination;
    use HasSorting; // trait para hacer el sorting en la tabla
    use HasSearching; // trait para los campos de busqueda en la tabla
    use HasComputedPlanes; // trait creado para gestionar las propiedades computadas para planes

    // actualiza el visto a 1 en las confirmaciones de una empresa con estado 1 y visto 0
    // el estado en las confirmaciones indica si una modelo aceptó o no la contratación
    // el visto en las confirmaciones indica si una empresa vió o no los datos personales de una modelo
    public function establecerVisto($plan)
    {
        Confirmacion::where('estado', 1)
            ->where('visto', 0)
            ->whereHas('contratacion.empresa', fn($query) => $query->where('user_id', $plan->user_id))
            ->update(['visto' => 1]);
    }

    // pone inactiva una contratación. Los criterios se evaluan en el método habilitarPlan
    public function deshabilitarContrataciones($plan)
    {
        Contratacion::whereHas('empresa', fn($query) => $query->where('user_id', $plan->user_id))
            ->where('estado', 1)
            ->update(['estado' => 0]);
    }

    // inicializa para cada contratacion la cantidad de modelos (cant_mod) que previamente habian confirmado
    // este metodo es un offset ya que permite continuar con la cantidad de modelos previamente confirmadas cuando se renueva un plan
    public function inicializaCantMod()
    {
        $contrataciones = Contratacion::whereHas('empresa', fn($query) => $query->where('user_id', $this->plan->user_id))->where('fec_fin', '>=', $this->fechaActual)->with('confirmaciones')->get(); // Carga previa de la relación confirmaciones

        $contrataciones->each(function ($contratacion) {
            $cantidad = $contratacion->confirmaciones->where('estado', 1)->count();
            $contratacion->update(['cant_mod' => $cantidad]);
        });
    }

    public function inicializarPlan($nom_ser)
    {
        switch ($nom_ser) {
            case 'plan simple':
                $this->fec_fin = null;
                $this->creditos = 1;
                break;
            case 'plan mensual':
                $this->fec_fin = Carbon::today()->addDays(30);
                $this->creditos = 5;
                break;
            case 'plan anual':
                $this->fec_fin = Carbon::today()->addDays(365);
                $this->creditos = 10000; // en realidad es infinito
                break;
        }
    }

    // permite al administrador habilitar o deshabilitar un plan para un usuario
    // el pedido es el plan que contrató el usuario
    public function habilitarPlan($planId)
    {
        $plan = Pedido::findOrFail($planId);
        $nom_ser = $plan->servicios()->first()->nom_ser;

        $this->inicializarPlan($nom_ser);

        if ($plan->habilita === null || $plan->habilita == 0) {
            $plan->update([
                'habilita' => 1,
                'fec_ini' => Carbon::today(),
                'fec_fin' => $this->fec_fin,
                'conf_ini' => 0,
                'creditos' => $this->creditos,
            ]);

            $this->deshabilitarContrataciones($plan);
            $this->dispatch('mostrar-alerta', tipo: 'success', mensaje: 'Se habilitó el plan del usuario ' . $plan->user->name);
        } else {
            $plan->update([
                'habilita' => null,
                'fec_ini' => null,
                'fec_fin' => null,
                'conf_ini' => 0,
                'creditos' => null,
            ]);

            $this->deshabilitarContrataciones($plan);
            $this->establecerVisto($plan);

            $this->dispatch('mostrar-alerta', tipo: 'error', mensaje: 'Se deshabilitó el plan del usuario ' . $plan->user->name);
        }
    }

    public function destroy(Pedido $plan)
    {
        $plan->delete();
        $this->dispatch('mostrar-alerta', tipo: 'error', mensaje: 'Se eliminó el plan de ' . $plan->user->name);
        $this->resetPage();
    }

}; ?>

<div class="border-base-content/25 w-full overflow-x-auto ">
    @if ($this->planes->count())
        <table>
            <thead>
                <tr>
                    <th>
                        @livewire('sorting.sortby', ["field"=>"id", "label"=>"ID", "sort_by" => $sort_by, "sortDirection" => $sortDirection])
                    </th>

                    <x-table.headers :columns="['Usuario', 'Teléfono', 'Plan seleccionado']" />

                    <th>
                        @livewire('sorting.sortby', ["field"=>"fec_ini", "label"=>"Inicio", "sort_by" => $sort_by, "sortDirection" => $sortDirection])
                    </th>
                    <th>
                        @livewire('sorting.sortby', ["field"=>"fec_fin", "label"=>"Finalizacion", "sort_by" => $sort_by, "sortDirection" => $sortDirection])
                    </th>

                    <x-table.headers :columns="['Créditos', 'Total']" />

                    <th>
                        @livewire('sorting.sortby', ["field"=>"habilita", "label"=>"Habilitar", "sort_by" => $sort_by, "sortDirection" => $sortDirection])
                    </th>
                    <th>
                        {{ __('Acciones') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->planes as $plan)
                    <tr wire:key="plan-{{ $plan->id }}" class="{{ $this->getPlanRowClass($plan) }}">
                        <td>{{ $plan->id }}</td>
                        <td>{{ $plan->user->name }}</td>
                        <td>{{ $plan->user->telefono }}</td>
                        <td>{{ $this->getNomSer($plan) }}</td>
                        <td>{{ $plan->fec_ini }}</td>
                        <td>{{ $plan->fec_fin }}</td>
                        <td>{{ $plan->creditos }}</td>
                        <td>{{ $plan->total }}</td>
                        <td>
                            <x-cards.button-habilita-planes :plan="$plan" />
                        </td>
                        <td>
                            <x-cards.button-icon-show route="planes.show" :param="$plan->id" />
                            <x-cards.button-icon-edit route="planes.edit" :param="$plan->id" />
                            <x-cards.button-icon-delete :param="$plan->id" tipo="el plan" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $this->planes->links() }}
        @can('pedidos.create')
            <div class="buttons-container">
                <x-cards.button-create route="planes.create">{{ __('Generar otro plan') }}</x-cards.button-create>
            </div>
        @endcan
    @else
        <!-- En caso que todavía no haya planes contratados -->
        <div class="buttons-container">
            <h2>{{ __('No hay planes contratados') }}</h2>
            <x-cards.button-create route="planes.create">{{ __('Contratar un plan') }}</x-cards.button-create>
        </div>
    @endif
</div>
