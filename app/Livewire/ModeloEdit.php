<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Modelo;


class ModeloEdit extends Component
{
    public $modelo, $modeloId, $profile_photo_url, $localidades;

    protected $rules = [
        'modelo.fec_nac' => 'required|date',
        'modelo.sexo' => 'required|in:M,F',
        'modelo.estatura' => 'required|numeric|between:1.40,2.35',
        'modelo.col_cab' => 'nullable|in:rubio,castaño,pelirrojo,morocho,otro',
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
    ];

    protected $messages = [
        'modelo.fec_nac.required' => 'La fecha de nacimiento es obligatoria.',
        'modelo.fec_nac.date' => 'La fecha de nacimiento debe ser una fecha válida.',
        'modelo.sexo.required' => 'El sexo es obligatorio.',
        'modelo.sexo.in' => 'El sexo debe ser Masculino o Femenino.',
        'modelo.estatura.required' => 'La estatura es obligatoria.',
        'modelo.estatura.numeric' => 'La estatura debe ser un número.',
        'modelo.estatura.between' => 'La estatura debe estar entre 1.40 y 2.35 metros.',
        'modelo.col_cab.in' => 'El color de cabello debe ser uno de los siguientes: rubio, castaño, pelirrojo, morocho, otro.',
        'modelo.medidas.string' => 'Las medidas deben ser un texto.',
        'modelo.calzado.numeric' => 'El calzado debe ser un número.',
        'modelo.calzado.between' => 'El calzado debe estar entre 30.0 y 45.0.',
        'modelo.zon_res.string' => 'La zona de residencia debe ser un texto.',
        'modelo.zon_res.max' => 'La zona de residencia no puede tener más de 100 caracteres.',
        'modelo.dis_via.boolean' => 'La disponibilidad para viajes debe ser verdadero o falso.',
        'modelo.tit_mod.boolean' => 'La titulación de modelo debe ser verdadero o falso.',
        'modelo.ingles.in' => 'El nivel de inglés debe ser uno de los siguientes: básico, intermedio, avanzado.',
        'modelo.dis_tra.string' => 'El tipo de trabajo debe ser un texto.',
        'modelo.descripcion.string' => 'La descripción debe ser un texto.',
        'modelo.tar_med.numeric' => 'La tarifa media debe ser un número.',
        'modelo.tar_com.numeric' => 'La tarifa completa debe ser un número.',
        'modelo.estado.boolean' => 'El estado debe ser verdadero o falso.',
    ];


    public function mount($modeloId)
    {
        $modelo = Modelo::findOrFail($modeloId);
        $this->profile_photo_url = $modelo->user->profile_photo_url;
        $this->modelo = $modelo->toArray();
        $this->modeloId = $modeloId;
        $this->localidades = include(public_path('storage/localidades/localidades.php'));
    }

    public function updateModelo()
    {

        $this->modelo['calzado'] = $this->modelo['calzado'] === '' ? null : $this->modelo['calzado'];
        $this->modelo['tar_med'] = $this->modelo['tar_med'] === '' ? null : $this->modelo['tar_med'];
        $this->modelo['tar_com'] = $this->modelo['tar_com'] === '' ? null : $this->modelo['tar_com'];

        $this->validate();

        $modelo = Modelo::findOrFail($this->modeloId);
        $modelo->update($this->modelo);
        session()->flash('message', '¡La ficha de la modelo '.$modelo->user->name. ' ha sido actualizada con éxito!');
        return redirect()->route('modelos.show', $this->modeloId);
    }

    public function render()
    {
        return view('livewire.modelo-edit');
    }
}
