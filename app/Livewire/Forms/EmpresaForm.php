<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Attributes\Locked;
use Livewire\Form;

class EmpresaForm extends Form
{
    #[Validate('required', message: 'El nombre comercial es obligatorio')]
    #[Validate('string', message: 'El nombre comercial debe ser una cadena de texto')]
    #[Validate('max:255', message: 'El nombre comercial no puede exceder los 255 caracteres')]
    public $nom_com;

    #[Validate('required', message: 'El domicilio es obligatorio')]
    #[Validate('string', message: 'El domicilio debe ser una cadena de texto')]
    #[Validate('max:255', message: 'El domicilio no puede exceder los 255 caracteres')]
    public $domicilio;

    #[Validate('required', message: 'El rubro es obligatorio')]
    #[Validate('string', message: 'El rubro debe ser una cadena de texto')]
    #[Validate('max:100', message: 'El rubro no puede exceder los 100 caracteres')]
    public $rubro;

    #[Validate('required', message: 'El tipo es obligatorio')]
    #[Validate('in:A,C', message: 'El tipo debe ser A o C')]
    public $tipo;

    #[Validate('required', message: 'El CUIT es obligatorio')]
    #[Validate('regex:/^\d{2}-\d{8}-\d{1}$/', message: 'El CUIT debe tener el formato XX-XXXXXXXX-X')]
    public $cuit;

    #[Locked] 
    public $user_id;
}
