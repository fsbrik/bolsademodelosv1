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
            'tipo' => 'required|in:A,C',
            'cuit' => ['required', 'regex:/^\d{2}-\d{8}-\d{1}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'nom_com.required' => 'El nombre comercial es obligatorio.',
            'nom_com.string' => 'El nombre comercial debe ser una texto.',
            'nom_com.max' => 'El nombre comercial no debe exceder los 100 caracteres.',

            'domicilio.required' => 'El domicilio es obligatorio.',
            'domicilio.string' => 'El domicilio debe ser una texto.',
            'domicilio.max' => 'El domicilio no debe exceder los 255 caracteres.',

            'rubro.required' => 'El rubro es obligatorio.',
            'rubro.string' => 'El rubro debe ser una texto.',
            'rubro.max' => 'El rubro no debe exceder los 100 caracteres.',

            'tipo.required' => 'El tipo de factura es obligatorio.',
            'tipo.in' => 'El tipo de factura debe ser "A" o "C".',

            'cuit.required' => 'El CUIT es obligatorio.',
            'cuit.regex' => 'El CUIT debe tener el formato XX-XXXXXXXX-X donde X son números.',
        ];
    }
}
