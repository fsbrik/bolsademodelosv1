@props(['route' => false])
<x-button>
    @if($route)
        <a wire:navigate href="{{ route($route) }}">
            {{ $slot }}
        </a>
    @else
        {{ $slot }}
    @endif
</x-button>


