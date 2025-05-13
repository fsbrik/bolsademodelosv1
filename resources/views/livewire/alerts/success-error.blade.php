<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;

new class extends Component {
    public $tipo;
    public $mensaje;

    #[On('mostrar-alerta')]
    public function mostrar($tipo, $mensaje)
    {
        $this->tipo = $tipo;
        $this->mensaje = $mensaje;
    }

    public function cerrar()
    {
        $this->mensaje = null;
    }
}; ?>

<div>
    @if ($mensaje)
        <div x-data="{ open }" 
             x-init="open = true"
             x-show="open" x-transition
            class="relative p-4 mb-4 text-sm text-white rounded-md 
            {{ $tipo === 'success' ? 'bg-green-300' : ($tipo === 'error' ? 'bg-red-500' : 'bg-blue-500') }}">
            <button @click="open = false; @this.cerrar()" class="absolute top-2 right-2 text-white hover:text-gray-300">
                ✕
            </button>
            {{ $mensaje }}
        </div>
    @endif
</div>
