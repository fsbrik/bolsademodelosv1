@props(['route', 'hidden' => false])

@if (!$hidden)
    <a href="{{ route($route) }}" {{ $attributes->merge(['class' => 'a-btn']) }}>
        {{ $slot }}
    </a>
@endif
