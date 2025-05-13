@props(['route', 'param', 'hidden' => false])

@if (!$hidden)
    <a href="{{ route($route, $param) }}" class="text-yellow-500 hover:text-yellow-700 text-pretty ml-1" title="Editar">
        <i class="fas fa-edit"></i>
    </a>
@endif
