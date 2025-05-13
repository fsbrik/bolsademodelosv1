<?php

namespace App\Livewire\Empresas;

use App\Livewire\Forms\EmpresaForm;
use Livewire\Component;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class EmpresaShow extends Component
{
    public $empresa;

    public function mount($empresaId)
    {
        $this->empresa = Empresa::findOrFail($empresaId);

    }

    /* use WithPagination; */

    /* public EmpresaForm $empresa;
    public Empresa $empresaOriginal;
    public $empresaId; */

    

    /* public function mount($empresaId)
    {
        $this->empresaOriginal = Empresa::findOrFail($empresaId);       
        $this->empresa->fill($this->empresaOriginal->toArray()); // Cargar los valores del modelo en el Form Object
        $this->empresaId = $empresaId;
    } */

    /* public function destroy(){
        $this->empresaOriginal->delete();

        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $empresas = Empresa::query();        }
        else {
            $empresas = Empresa::where('user_id', $user->id);
        }

        $empresas = $empresas->paginate(10);
        
        session()->flash('message', $this->empresaOriginal->nom_com.' se eliminó con éxito.');

       return redirect()->route('empresas.index', compact('empresas'));
    } */

    public function render()
    {
        return view('livewire.empresas.empresa-show');
    }
}
