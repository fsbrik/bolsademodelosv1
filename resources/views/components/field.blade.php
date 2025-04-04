@props(["span" => 1])

<div {!! $attributes->merge(['class' => 'col-span-12 sm:col-span-'.$span]) !!}>
    {{ $slot }}
</div>