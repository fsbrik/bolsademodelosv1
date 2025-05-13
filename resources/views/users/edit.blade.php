<x-app-layout>
    <x-slot name="header">
        <x-header bold='true'>
            {{ __('Editar usuario: '.$user->name) }}
        </x-header>
    </x-slot>
    <x-container>            
            @livewire('users.user-edit', ['userId' => $user->id])
    </x-container>    
</x-app-layout>
