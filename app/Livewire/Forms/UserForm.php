<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Attributes\Locked;
use Livewire\Form;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserForm extends Form
{
    #[Validate('required', message: 'El nombre es obligatorio')]
    #[Validate('string', message: 'El nombre debe ser una cadena de texto')]
    #[Validate('max:255', message: 'El nombre no puede superar los 255 caracteres')]
    public $name;

    #[Validate('required', message: 'El teléfono es obligatorio')]
    #[Validate('string', message: 'El teléfono debe ser una cadena de texto')]
    #[Validate('max:20', message: 'El teléfono no puede superar los 20 caracteres')]
    public $telefono;

    public $email;

    #[Validate('nullable')]
    #[Validate('image', message: 'La foto debe ser una imagen')]
    #[Validate('max:1024', message: 'La imagen no debe superar 1MB')]
    public $photo;

    #[Locked]
    public $id;

    public function boot(User $user)
    {
        // Reglas dinámicas
        $this->rules['email'] = 'required|email|max:255|unique:users,email,' . $user->id;

        // Mensajes personalizados
        $this->messages = [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.max' => 'El correo electrónico no puede superar los 255 caracteres.',
            'email.unique' => 'Este correo ya está registrado por otro usuario.',
        ];
    }
}
