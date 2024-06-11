<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModeloRequest extends FormRequest
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
            'fec_nac' => 'required|date',
            'sexo' => 'required|in:M,F', // Asumiendo que solo se permiten 'M' y 'F'
             'estatura' => 'required|numeric|between:1.45,2.10',
            'medidas' => 'required|string',
            'calzado' => 'nullable|numeric|between:34.0,42.0',
            'zon_res' => 'nullable|string|max:100',
            'dis_via' => 'nullable|boolean',
            'tit_mod' => 'nullable|boolean',
            'ingles' => 'nullable|in:basico,intermedio,avanzado',
            'dis_tra' => 'nullable|in:modelo,promotor/a,ambos',
            'descripcion' => 'nullable|string',
            'tar_med' => 'nullable|numeric',
            'tar_com' => 'nullable|numeric',
            'estado' => 'nullable|boolean',
            'habilita' => 'nullable|boolean', 
        ];
    }
}
