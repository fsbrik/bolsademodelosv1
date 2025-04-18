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
            'empresa.nom_com' => ['required', 'string', 'max:255'],
            'empresa.domicilio' => ['required', 'string', 'max:100'],
            'empresa.rubro' => ['required', 'string', 'max:255'],
            'empresa.tipo' => ['required', 'in:A,C'], // Asumiendo que solo se permiten 'A' y 'C'
            'empresa.cuit' => ['required', 'regex:/^\d{2}-\d{8}-\d{1}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'empresa.nom_com.required' => 'El nombre comercial es obligatorio.',
            'empresa.nom_com.string' => 'El nombre comercial debe ser una cadena de texto.',
            'empresa.nom_com.max' => 'El nombre comercial no puede exceder los 100 caracteres.',

            'empresa.domicilio.required' => 'El domicilio es obligatorio.',
            'empresa.domicilio.string' => 'El domicilio debe ser una cadena de texto.',
            'empresa.domicilio.max' => 'El domicilio no puede exceder los 255 caracteres.',

            'empresa.rubro.required' => 'El rubro es obligatorio.',
            'empresa.rubro.string' => 'El rubro debe ser una cadena de texto.',
            'empresa.rubro.max' => 'El rubro no puede exceder los 100 caracteres.',

            'empresa.tipo.required' => 'El tipo es obligatorio.',
            'empresa.tipo.in' => 'El tipo debe ser A o C.',

            'empresa.cuit.required' => 'El CUIT es obligatorio.',
            'empresa.cuit.regex' => 'El CUIT debe tener el formato XX-XXXXXXXX-X.',
        ];
    }
}
