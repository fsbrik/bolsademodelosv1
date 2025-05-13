<x-app-layout>
    <x-slot name="header">
        <x-header bold='true'>
            {{ __('Detalles del usuario: '.$user->name) }}
        </x-header>
    </x-slot>
    <x-container>            
            @livewire('users.user-show', ['userId' => $user->id])
    </x-container>
</x-app-layout>
