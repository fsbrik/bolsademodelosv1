@props(['route', 'param', 'hidden' => false])

@if (!$hidden)
    <a href="{{ route($route, $param) }}" class=" text-indigo-500 hover:text-indigo-700 text-pretty" title="Ver">
        <i class="fas fa-eye"></i>
    </a>
@endif
