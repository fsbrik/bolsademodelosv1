@props(['value'])

<label {{ $attributes->merge(['class' => 'block label-small text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
