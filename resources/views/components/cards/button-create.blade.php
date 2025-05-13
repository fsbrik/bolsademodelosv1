@props(['route'])

<a href="{{ route($route) }}" {{ $attributes->merge(['class' => 'a-btn-create']) }} title="Crear">
    {{ $slot }}
</a>
