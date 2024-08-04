<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Modelo;

class ModeloIndex extends Component
{
    public $searchModId, $searchName, $searchTelefono, $searchEmail;
    public $searchEdadMin, $searchEdadMax, $searchSexo, $searchEstaturaMin, $searchEstaturaMax;
    public $searchZonRes, $searchDisVia, $searchTitMod, $searchIngles, $searchDisTra, $searchCabello;
    public $searchTarMedMin, $searchTarMedMax, $searchTarComMin, $searchTarComMax;
    public $searchEstado, $searchHabilita;
    public $localidades = [];
    public $sort_By = null, $sortDirection = 'asc';
    public $showTable = true;
    
    use WithPagination;

    public function mount(){
        $this->localidades = include(public_path('storage/localidades/localidades.php'));
    }

    public function toggleView()
    {
        $this->showTable = !$this->showTable;
    }

    public function updating($field)
    {
        if (in_array($field, [
            'searchModId', 'searchName', 'searchTelefono', 'searchEmail',
            'searchEdadMin', 'searchEdadMax', 'searchSexo', 'searchEstaturaMin', 'searchEstaturaMax',
            'searchCabello', 'searchZonRes', 'searchDisVia', 'searchTitMod', 'searchIngles', 'searchDisTra',
            'searchTarMedMin', 'searchTarMedMax', 'searchTarComMin', 'searchTarComMax',
            'searchEstado', 'searchHabilita'
        ])) {
            $this->resetPage();
        }
    }

    public function sortBy($field)
    {
        if ($this->sort_By === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort_By = $field;
            $this->sortDirection = 'asc';
        }
        //$this->sort_By = $field;
    }

    public function render()
    {
        $modelos = Modelo::query();

        if ($this->searchModId) {
            $modelos->where('mod_id', 'like', '%' . $this->searchModId . '%');
        }

        if ($this->searchName || $this->searchTelefono || $this->searchEmail) {
            $modelos->whereHas('user', function ($query) {
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

        if ($this->searchEdadMin || $this->searchEdadMax) {
            $minAge = $this->searchEdadMin ?? 0;
            $maxAge = $this->searchEdadMax ?? 150; // Un valor alto por defecto para el límite máximo de edad
            $modelos->whereRaw('TIMESTAMPDIFF(YEAR, fec_nac, CURDATE()) BETWEEN ? AND ?', [$minAge, $maxAge]);
        }
        

        if ($this->searchSexo) {
            $modelos->where('sexo', 'like', '%' . $this->searchSexo . '%');
        }

        if ($this->searchEstaturaMin || $this->searchEstaturaMax) {
            $modelos->whereBetween('estatura', [$this->searchEstaturaMin, $this->searchEstaturaMax]);
        }

        if ($this->searchCabello) {
            $modelos->where('col_cab', 'like', '%' . $this->searchCabello . '%');
        }

        if ($this->searchZonRes) {
            $modelos->where('zon_res', 'like', '%' . $this->searchZonRes . '%');
        }

        if (!is_null($this->searchDisVia)) {
            $modelos->where('dis_via', 'like', '%' . $this->searchDisVia . '%');
        }

        if (!is_null($this->searchTitMod)) {
            $modelos->where('tit_mod', 'like', '%' . $this->searchTitMod . '%');
        }

        if ($this->searchIngles) {
            $modelos->where('ingles', 'like', '%' . $this->searchIngles . '%');
        }

        if ($this->searchDisTra) {
            $modelos->where('dis_tra', 'like', '%' . $this->searchDisTra . '%');
        }

        if ($this->searchTarMedMin || $this->searchTarMedMax) {
            $modelos->whereBetween('tar_med', [$this->searchTarMedMin, $this->searchTarMedMax]);
        }

        if ($this->searchTarComMin || $this->searchTarComMax) {
            $modelos->whereBetween('tar_com', [$this->searchTarComMin, $this->searchTarComMax]);
        }

        if ($this->sort_By) {
            $modelos->orderBy($this->sort_By, $this->sortDirection);
        }

        if (!is_null($this->searchEstado)) {
            $modelos->where('estado', 'like', '%' . $this->searchEstado . '%');
        }

        if (!is_null($this->searchHabilita)) {
            $modelos->where('habilita', 'like', '%' . $this->searchHabilita . '%');
        }

        $modelos = $modelos->paginate(10);
        $localidades = $this->localidades;

        return view('livewire.admin.modelo-index', compact('modelos', 'localidades'));
    }
}
