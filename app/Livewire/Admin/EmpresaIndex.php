<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Empresa;

class EmpresaIndex extends Component
{
    public $searchName, $searchTelefono, $searchEmail;
    public $searchComercial, $searchCuit;
    
    use WithPagination;

    public function updating($field)
    {
        if (in_array($field, ['searchName', 'searchTelefono', 'searchEmail', 'searchComercial', 'searchCuit'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $empresas = Empresa::query();

        if ($this->searchName || $this->searchTelefono || $this->searchEmail) {
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
        }

        if ($this->searchComercial) {
            $empresas->where('nom_com', 'like', '%' . $this->searchComercial . '%');
        }

        if ($this->searchCuit) {
            $empresas->where('cuit', 'like', '%' . $this->searchCuit . '%');
        }

        $empresas = $empresas->paginate(10);

        return view('livewire.admin.empresa-index', compact('empresas'));
    }
}
