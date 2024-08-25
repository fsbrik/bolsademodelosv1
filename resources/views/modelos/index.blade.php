<x-app-layout>
    @livewire('admin.modelo-index')
    @guest <x-slot name="footer"></x-slot> @endguest
</x-app-layout>
