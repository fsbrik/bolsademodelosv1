<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
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
            'nom_com' => 'required|string|max:100',
            'domicilio' => 'required|string|max:255',
            'rubro' => 'required|string|max:100',
            'tipo' => 'required|in:A,C', // Asumiendo que solo se permiten 'M' y 'F'
            'cuit' => ['required', 'regex:/^\d{2}-\d{8}-\d{1}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'cuit' => 'El campo CUIT debe tener el formato XX-XXXXXXXX-X donde X son números.',
            // otros mensajes de error
        ];
    }
}
