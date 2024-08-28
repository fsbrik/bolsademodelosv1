<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;

class ServicioEdit extends Component
{
    public $servicioId;
    public $nom_ser;
    public $cat_ser, $sub_cat;
    public $des_ser;
    public $precio;
    public $hab_ser;

    protected $rules = [
        'nom_ser' => 'required|string|max:100',
        'cat_ser' => 'required|string|in:modelo,empresa',
        'sub_cat' => 'nullable|in:reservas,contrataciones',
        'des_ser' => 'required|string',
        'precio' => 'required|numeric|min:0',
        'hab_ser' => 'required|boolean',
    ];

    public function messages()
    {
        return [
            'nom_ser.required' => 'El nombre del servicio es obligatorio.',
            'nom_ser.max' => 'El nombre del servicio no puede superar los 100 caracteres.',
            'cat_ser.required' => 'La categoría del servicio es obligatoria.',
            'cat_ser.in' => 'La categoría del servicio debe ser "modelo" o "empresa".',
            'sub_cat.in' => 'La subcategoría del servicio debe ser vacía, "reservas" o "contrataciones".',
            'des_ser.required' => 'La descripción del servicio es obligatoria.',
            'precio.required' => 'El precio del servicio es obligatorio.',
            'precio.numeric' => 'El precio del servicio debe ser un número.',
            'precio.min' => 'El precio del servicio debe ser al menos 0.',
            'hab_ser.required' => 'El estado del servicio es obligatorio.',
            'hab_ser.boolean' => 'El estado del servicio debe ser verdadero o falso.',
        ];
    }

    public function mount($servicioId)
    {
        $servicio = Servicio::findOrFail($servicioId);
        $this->fill($servicio->toArray());
        $this->servicioId = $servicio->id;
    }

    public function submit()
    {
        $this->validate();

        $servicio = Servicio::findOrFail($this->servicioId);
        $servicio->update($this->validate());

        session()->flash('message', 'Servicio actualizado exitosamente.');
        return redirect()->route('servicios.show', $this->servicioId);
    }

    public function render()
    {
        return view('livewire.servicio-edit');
    }
}
