<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
class EmpresaShow extends Component
{
 
    public $empresa;

    use WithPagination;

    public function mount($empresaId)
    {
        $empresa = Empresa::findOrFail($empresaId);
        $this->empresa = $empresa->toArray();    
    } 

    public function destroy(){
        $empresa = Empresa::findOrFail($this->empresa['id']);
        //dd($empresa);
        $empresa->delete();

        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $empresas = Empresa::query();        }
        else {
            $empresas = Empresa::where('user_id', $user->id);
        }

        $empresas = $empresas->paginate(10);

        session()->flash('message', 'se eliminó la empresa de '.$empresa->user->name);
       return redirect()->route('empresas.index', compact('empresas'));
    }

    public function render()
    {
        return view('livewire.empresa-show');
    }
}
