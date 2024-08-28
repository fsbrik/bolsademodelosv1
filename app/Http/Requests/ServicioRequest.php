<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom_ser' => 'required|string|max:100',
            'cat_ser' => 'required|in:modelo,empresa',
            'sub_cat' => 'nullable|in:reservas,contrataciones',
            'des_ser' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'hab_ser' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'nom_ser.required' => 'El nombre del servicio es obligatorio.',
            'nom_ser.max' => 'El nombre del servicio no puede superar los 100 caracteres.',
            'cat_ser.required' => 'La categoría del servicio es obligatoria.',
            'cat_ser.in' => 'La categoría del servicio debe ser "modelo" o "empresa".',
            'sub_cat.in' => 'La subcategoría del servicio puede ser nula, "reservas" o "contrataciones".',
            'des_ser.required' => 'La descripción del servicio es obligatoria.',
            'precio.required' => 'El precio del servicio es obligatorio.',
            'precio.numeric' => 'El precio del servicio debe ser un número.',
            'precio.min' => 'El precio del servicio debe ser al menos 0.',
            'hab_ser.required' => 'El estado del servicio es obligatorio.',
            'hab_ser.boolean' => 'El estado del servicio debe ser verdadero o falso.',
        ];
    }
}
