<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Locked;

class PlanForm extends Form
{
    #[Validate('required', message: 'Debe seleccionar un plan.')]
    #[Validate('in:plan simple,plan mensual,plan anual', message: 'El plan seleccionado no es válido.')]
    public string $planSeleccionado = '';

    /* #[Validate('required', message: 'El usuario es obligatorio.')]
    #[Validate('integer', message: 'Tipo de usuario inválido.')]
    #[Validate('exists:users,id', message: 'El usuario no es válido.')] */

    #[Validate('required', message: 'Debe seleccionar un usuario')]
    public ?int $userId = null;

    #[Validate('declined', message: 'Ya hay un plan creado para este usuario!')]
    public $planPreexistente = false;
}

