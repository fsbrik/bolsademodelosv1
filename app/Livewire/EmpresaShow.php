<?php

namespace App\Livewire;

use App\Livewire\Forms\EmpresaForm;
use Livewire\Component;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
class EmpresaShow extends Component
{
 
    /* public $empresa;
    public Empresa $empresaOriginal; */

    use WithPagination;

    /* public function mount($empresaId)
    {
        $this->empresaOriginal = Empresa::findOrFail($empresaId); 
        $this->empresa = $this->empresaOriginal->toArray(); // Cargar los valores del modelo en el Form Object 
    }  */

    public EmpresaForm $empresa;
    public Empresa $empresaOriginal;

    

    public function mount($empresaId)
    {
        $this->empresaOriginal = Empresa::findOrFail($empresaId);       
        $this->empresa->fill($this->empresaOriginal->toArray()); // Cargar los valores del modelo en el Form Object
        
    }

    public function destroy(){
        $this->empresaOriginal->delete();

        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $empresas = Empresa::query();        }
        else {
            $empresas = Empresa::where('user_id', $user->id);
        }

        $empresas = $empresas->paginate(10);

        session()->flash('message', 'se eliminó la empresa de '.$this->empresaOriginal->user->name);
       return redirect()->route('empresas.index', compact('empresas'));
    }

    public function render()
    {
        return view('livewire.empresa-show');
    }
}
