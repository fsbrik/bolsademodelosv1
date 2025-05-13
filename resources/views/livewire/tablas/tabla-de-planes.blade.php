<?php

use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use App\Traits\Planes\HasComputedPlanes;
use App\Models\Pedido;
use Livewire\Attributes\Computed;

new class extends Component {

    use WithPagination;
    use HasComputedPlanes;  // todas las propiedades computadas estan en este trait

    public function destroy(){
        $this->plan->delete();
        $this->dispatch('mostrar-alerta', tipo: 'error', mensaje: 'Se eliminó el plan de '.$this->plan->user->name);
        unset($this->plan);
    }

}; ?>

<div class="border-base-content/25 w-full overflow-x-auto ">
    @if (isset($this->plan))
    <table>
        <thead>
            <tr>
                <x-table.headers :columns="['ID', 'Plan contratado', 'Fecha de inicio', 'Vencimiento', 'Créditos disponibles', 'Total', 'Estado', 'Acciones']" />
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{ $this->plan->id }}
                </td>
                <td>
                    {{ $this->nom_ser }}
                </td>
                <td>
                    {{ $this->fec_ini }}
                </td>
                <td>
                    {{ $this->fec_fin }}
                </td>
                <td>
                    {{ $this->creditos }}
                </td>
                <td>
                    {{ $this->plan->total }}
                </td>
                <td>
                    {{ $this->habilita }}
                </td>
                <td>
                    @if ($this->getHabilita())
                        <x-cards.button-edit-planes route="planes.edit" :param="$this->plan->id"/>
                    @endif

                    <x-cards.button-icon-show route="planes.show" :param="$this->plan->id" />

                    @if ($this->getHabilita())
                        <x-cards.button-icon-delete tipo="el plan a contratar" />
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    @else
    <!-- En caso que todavía no haya ningun plan creado -->
    <div class="card">
        <h2>No tenés ningún plan contratado aún</h2>        
        <x-cards.button-create route="planes.create">{{ __('Contratar un plan') }}</x-cards.button-create>
    </div>
    @endif
</div>
