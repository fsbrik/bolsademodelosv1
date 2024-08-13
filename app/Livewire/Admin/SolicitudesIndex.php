<?php

namespace App\Livewire\Admin;
use App\Models\Modelo;
use Livewire\Component;
use Livewire\WithPagination;

class SolicitudesIndex extends Component
{

    public $searchName, $searchTelefono, $searchEmail;

    use WithPagination;

    public function updating($field)
    {
        if(in_array($field, [
            'searchName', 'searchTelefono', 'searchEmail'
        ])) {
           $this->resetPage(); 
        }        
    }

    public function update($modeloId)
    {

        $modelo = Modelo::findOrFail($modeloId);
        $modelo->habilita = 1;
        $modelo->save();
        $modelos = Modelo::where('habilita', 0)->orderBy('created_at');

        session()->flash('message', $modelo->user->name.' ya está habilitada!');
        $modelos = $modelos->paginate(10);

        return view('livewire.admin.solicitudes-index', compact('modelos'));
    }
    
    public function render()
    {
        $modelos = Modelo::where('habilita', 0)->orderBy('created_at');

         //$modelos = Modelo::query();

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

        $modelos = $modelos->paginate(10);

        return view('livewire.admin.solicitudes-index', compact('modelos'));
    }
}
