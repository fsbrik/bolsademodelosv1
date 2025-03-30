<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Modelo;
use Illuminate\Support\Facades\Auth;

class ModeloCreate extends Component
{
    public $fec_nac, $sexo = "F", $estatura, $col_cab, $medidas, $calzado, $zon_res, $dis_via = 0;
    public $tit_mod = 0, $ingles = "basico", $dis_tra = "modelo", $descripcion, $tar_med, $tar_com, $estado = 1;
    public $localidades;
    public $mod_id;

    protected $rules = [
        'fec_nac' => 'required|date',
        'sexo' => 'required|in:M,F',
        'estatura' => 'required|numeric|between:1.40,2.35',
        'col_cab' => 'nullable|in:rubio,castaño,pelirrojo,morocho,otro',
        'medidas' => 'nullable|string',
        'calzado' => 'nullable|numeric|between:30.0,45.0',
        'zon_res' => 'nullable|string|max:100',
        'dis_via' => 'nullable|boolean',
        'tit_mod' => 'nullable|boolean',
        'ingles' => 'nullable|in:basico,intermedio,avanzado',
        'dis_tra' => 'nullable|string',
        'descripcion' => 'nullable|string',
        'tar_med' => 'nullable|numeric',
        'tar_com' => 'nullable|numeric',
        'estado' => 'required|boolean',
    ];

    protected $messages = [
        'fec_nac.required' => 'La fecha de nacimiento es obligatoria.',
        'fec_nac.date' => 'La fecha de nacimiento debe ser una fecha válida.',
        'sexo.required' => 'El sexo es obligatorio.',
        'sexo.in' => 'El sexo debe ser Masculino o Femenino.',
        'estatura.required' => 'La estatura es obligatoria.',
        'estatura.numeric' => 'La estatura debe ser un número. Utilizá el punto "." en vez de la coma ","',
        'estatura.between' => 'La estatura debe estar entre 1.40 y 2.35 metros.',
        'col_cab.in' => 'El color de cabello debe ser uno de los siguientes: rubio, castaño, pelirrojo, morocho, otro.',
        'medidas.string' => 'Las medidas deben ser un texto.',
        'calzado.numeric' => 'El calzado debe ser un número.',
        'calzado.between' => 'El calzado debe estar entre 30.0 y 45.0.',
        'zon_res.string' => 'La zona de residencia debe ser un texto.',
        'zon_res.max' => 'La zona de residencia no puede tener más de 100 caracteres.',
        'dis_via.boolean' => 'La disponibilidad para viajes debe ser verdadero o falso.',
        'tit_mod.boolean' => 'La titulación de modelo debe ser verdadero o falso.',
        'ingles.in' => 'El nivel de inglés debe ser uno de los siguientes: básico, intermedio, avanzado.',
        'dis_tra.string' => 'El tipo de trabajo debe ser un texto.',
        'descripcion.string' => 'La descripción debe ser un texto.',
        'tar_med.numeric' => 'La tarifa media debe ser un número.',
        'tar_com.numeric' => 'La tarifa completa debe ser un número.',
        'estado.required' => 'El estado es obligatorio.',
        'estado.boolean' => 'El estado debe ser verdadero o falso.',
    ];

    public function mount(){
        $this->fec_nac = date('2003-04-15');
        $this->estatura = '1.72';

        $this->localidades = include(public_path('storage/localidades/localidades.php'));
    }

    public function store(){   
        
        $ultimoModId = Modelo::max('id'); // Obtener el valor más alto de id
        $nuevoModId = ++$ultimoModId; // Incrementar el valor en uno para obtener el siguiente

        $this->mod_id = 'mod' . $nuevoModId;
        
        // Convertir cadenas vacías a null para campos numéricos antes de crear
        $data = collect($this->only([
            'fec_nac', 'sexo', 'estatura', 'col_cab', 'medidas', 'calzado',
            'zon_res', 'dis_via', 'tit_mod', 'ingles', 'dis_tra', 'descripcion',
            'tar_med', 'tar_com', 'estado'
        ]))->map(fn($value) => $value === '' ? null : $value)->toArray();

        // Agregar campos adicionales que no vienen del formulario
        $data['mod_id'] = $this->mod_id;
        $data['user_id'] = Auth::user()->id;
        $data['habilita'] = 0;

        // Crear el modelo con la información optimizada
        $modelo = Modelo::create($data);
        
        //$this->validate();

        // Convertir cadenas vacías a null para evitar errores de inserción
        /* $this->col_cab = $this->col_cab === '' ? null : $this->col_cab;
        $this->calzado = $this->calzado === '' ? null : $this->calzado;
        $this->dis_via = $this->dis_via === '' ? null : $this->dis_via;
        $this->tit_mod = $this->tit_mod === '' ? null : $this->tit_mod;
        $this->ingles = $this->ingles === '' ? null : $this->ingles;
        $this->tar_med = $this->tar_med === '' ? null : $this->tar_med;
        $this->tar_com = $this->tar_com === '' ? null : $this->tar_com;
        $this->calzado = $this->calzado === '' ? null : $this->calzado; */

        /* $modelo = Modelo::create([
            'mod_id' => $this->mod_id,
            'fec_nac' => $this->fec_nac,
            'sexo' => $this->sexo,
            'estatura' => $this->estatura,
            'col_cab' => $this->col_cab,
            'medidas' => $this->medidas,
            'calzado' => $this->calzado,
            'zon_res' => $this->zon_res,
            'dis_via' => $this->dis_via,
            'tit_mod' => $this->tit_mod,
            'ingles' => $this->ingles,
            'dis_tra' => $this->dis_tra,
            'descripcion' => $this->descripcion,
            'tar_med' => $this->tar_med,
            'tar_com' => $this->tar_com,
            'estado' => $this->estado,
            'habilita' => 0,
            'user_id' => Auth::user()->id 
        ]); */

        session()->flash('message', '¡Creaste tu ficha exitosamente!');
        return redirect()->route('modelos.show', $modelo->id);

    }

    public function render()
    {
        return view('livewire.modelo-create');
    }
}
