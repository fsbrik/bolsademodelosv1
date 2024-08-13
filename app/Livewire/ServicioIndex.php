<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Servicio;

class ServicioIndex extends Component
{
    public $searchName, $searchCategory, $searchSubCategory, $searchDescription;
    public $user;

    use WithPagination;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function updating($field)
    {
        if (in_array($field, ['searchName', 'searchCategory', 'searchSubCategory', 'searchDescription'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        if ($this->user->hasRole('admin')) {
            $servicios = Servicio::query();
        } elseif ($this->user->hasRole('empresa')) {
            $servicios = Servicio::query()->where('cat_ser', 'empresa');
        } elseif ($this->user->hasRole('modelo')) {
            $servicios = Servicio::query()->where('cat_ser', 'modelo');
        }
        

        /* if ($this->searchName || $this->searchTelefono || $this->searchEmail) {
            $empresas->whereHas('user', function ($query) {
                if ($this->searchName) {
                    $query->where('name', 'like', '%' . $this->searchName . '%');
                }
                if ($this->searchTelefono) {
                    $query->where('telefono', 'like', '%' . $this->searchTelefono . '%');
                }
                if ($this->searchEmail) {
                    $query->where('email', 'like', '%' . $this->searchEmail . '%');
                }
            });
        } */

        if ($this->searchName) {
            $servicios->where('nom_ser', 'like', '%' . $this->searchName . '%');
        }

        if ($this->searchCategory) {
            $servicios->where('cat_ser', 'like', '%' . $this->searchCategory . '%');
        }

        if ($this->searchSubCategory) {
            $servicios->where('sub_cat', 'like', '%' . $this->searchSubCategory . '%');
        }

        if ($this->searchDescription) {
            $servicios->where('des_ser', 'like', '%' . $this->searchDescription . '%');
        }

        $servicios = $servicios->paginate(10);

        return view('livewire.servicio-index', compact('servicios'));
    }
}
