<x-app-layout>
    @livewire('modelos.modelo-index')
    @guest <x-slot name="footer"></x-slot> @endguest
</x-app-layout>
