<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;

class EmpresaIndex extends Component
{
    public $searchName, $searchTelefono, $searchEmail;
    public $searchComercial, $searchCuit;
    public $user;

    use WithPagination;

    public function updating($field)
    {
        if (in_array($field, ['searchName', 'searchTelefono', 'searchEmail', 'searchComercial', 'searchCuit'])) {
            $this->resetPage();
        }
    }

    public function userType(){
        $this->user = Auth::user();

        if ($this->user->hasRole('admin')) {
            $this->empresas = Empresa::query();
        } else {
            $this->empresas = Empresa::where('user_id', $this->user->id);
        }
    }

    public function destroy(Empresa $empresa){
        $empresa->delete();
        return redirect()->route('empresas.index');
        session()->flash('message', 'Empresa eliminada con éxito.');
    }

    public function render()
    {
        $this->user = Auth::user();

        if ($this->user->hasRole('admin')) {
            $empresas = Empresa::query();
        } else {
            $empresas = Empresa::where('user_id', $this->user->id);
        }

        if ($this->user->hasRole('admin') && ($this->searchName || $this->searchTelefono || $this->searchEmail)) {
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
        
        return view('livewire.admin.empresa-index', ['empresas' => $empresas]);
    }
}
