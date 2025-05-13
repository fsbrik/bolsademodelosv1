<?php

namespace App\Traits\Planes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use App\Models\Pedido;

trait HasComputedPlanes
{
    #[Computed]
    public function user()
    {
        return Auth::user();
    }

    public function initFechaActual()
    {
        $this->fechaActual = Carbon::today();
    }

    public function getPlanRowClass($plan)
    {
        return $plan->habilita === 0 ? 'bg-red-300 text-white' : '';
    }

    public function getNomSer($plan)
    {
        return $plan->servicios->first()->nom_ser ?? '—';
    }

    #[Computed]
    public function nom_ser()
    {
        return $this->plan->servicios->first()->nom_ser;
    }

    #[Computed]
    public function fec_ini()
    {
        return $this->plan->fec_ini ? Carbon::parse($this->plan->fec_ini)->format('d/m/Y') : '-';
    }

    #[Computed]
    public function fec_fin()
    {
        return $this->plan->fec_fin ? Carbon::parse($this->plan->fec_fin)->format('d/m/Y') : '-';
    }

    #[Computed]
    public function creditos()
    {
        return $this->plan->creditos == 10000 ? 'infinito' : ($this->plan->creditos ?? '-');
    }

    #[Computed]
    public function habilita()
    {
        return $this->plan->habilita == 1 ? 'Habilitado' : 'No habilitado';
    }

    #[Computed]
    public function getHabilita() //esto hay que resolverlo de otra manera
    {
        return $this->plan->habilita == 1 ? false : true;
    }

    #[Computed]
    public function plan()
    {
        return Pedido::where('user_id', $this->user->id)
            ->whereHas('servicios', function ($query) {
                $query->where('cat_ser', 'empresa')
                    ->where('sub_cat', 'planes');
            })
            ->where(function ($query) {
                $query->where('habilita', '<>', 0)
                    ->orWhereNull('habilita');
            })->orderBy('created_at', 'desc')->first();
    }

    #[Computed]
    public function planes()
    {
        $planes = Pedido::with(['user', 'servicios'])
            ->whereHas('servicios', function ($query) {
                $query->where('cat_ser', 'empresa')->where('sub_cat', 'planes');
            })
            ->where(function ($query) {
                $query
                    ->where('id', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('user', function ($query) {
                        $query->where('name', 'like', '%' . $this->searchTerm . '%');
                    })
                    ->orWhereHas('user', function ($query) {
                        $query->where('telefono', 'like', '%' . $this->searchTerm . '%');
                    });
            });

        $planes->orderBy($this->sort_by, $this->sortDirection);

        return $planes->paginate(10);
    }

}
