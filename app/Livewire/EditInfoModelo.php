<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Modelo;


class EditInfoModelo extends Component
{
    public $modelo, $modeloId, $localidades;

    public function mount($modeloId)
    {
        $modelo = modelo::findOrFail($modeloId);
        $this->modelo = $modelo->toArray();

        $this->localidades = include(public_path('storage/localidades/localidades.php'));

        /* $this->modeloId = $modeloId;
        $this->modelo['estado'] ? $this->modelo['estado']=true : $this->modelo['estado']=false;
        $this->modelo['habilita'] ? $this->modelo['habilita']=true : $this->modelo['habilita']=false; */
    }

    public function updateModelo()
    {
        $this->validate([
            'modelo.fec_nac' => 'required|date',
            'modelo.sexo' => 'required|in:M,F', // Asumiendo que solo se permiten 'M' y 'F'
            'modelo.estatura' => 'required|numeric|between:1.40,2.35',
            'modelo.medidas' => 'nullable|string',
            'modelo.calzado' => 'nullable|numeric|between:30.0,45.0',
            'modelo.zon_res' => 'nullable|string|max:100',
            'modelo.dis_via' => 'nullable|boolean',
            'modelo.tit_mod' => 'nullable|boolean',
            'modelo.ingles' => 'nullable|in:basico,intermedio,avanzado',
            'modelo.dis_tra' => 'nullable|string',
            'modelo.descripcion' => 'nullable|string',
            'modelo.tar_med' => 'nullable|numeric',
            'modelo.tar_com' => 'nullable|numeric',
            'modelo.estado' => 'boolean',
            'modelo.habilita' => 'boolean',
        ]);

        $modelo = modelo::findOrFail($this->modeloId);
        $modelo->update($this->modelo);
        session()->flash('message', '¡modelo actualizada con éxito!');
        return redirect()->route('modelos.show', $this->modeloId);
    }

    public function render()
    {
        return view('livewire.edit-info-modelo');
    }
}
