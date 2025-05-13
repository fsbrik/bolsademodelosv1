<x-app-layout>
    @if(Auth::user()->hasRole('empresa'))
        @livewire('planes.plan-index')
    @elseif(Auth::user()->hasRole('admin'))
        @livewire('admin.habilitar-planes')
    @endif
</x-app-layout>
