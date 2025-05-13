<?php

use Livewire\Volt\Component;

new class extends Component {
    public $tipoDeRuta;
    public $userOriginal;
}; ?>

<div class="buttons-container">
        
    @can('users.index')
        @switch($tipoDeRuta)
            @case('edit')
                <x-cards.button-delete :param="$userOriginal->id" tipo="al usuario {{ $userOriginal->name }}"/>
                <x-button wire:click="$parent.updateUser">{{ __('Actualizar') }}</x-button>
                @break
            @case('show')
                <x-cards.button-edit route="users.edit" :param="$userOriginal->id" />
                <x-cards.button-delete :param="$userOriginal->id" tipo="al usuario {{ $userOriginal->name }}" />
                @break
        @endswitch
                <x-cards.button-a route="users.index">{{ __('Volver') }}</x-cards.button-a>
    @endcan
</div>

