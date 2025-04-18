@props(['columns' => []])

@foreach ($columns as $column)
    <th {{ $attributes }}>{{ $column }}</th>
@endforeach