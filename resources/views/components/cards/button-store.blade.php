@props(['param' => false])

<button type="button" {{ $attributes->merge(['class' => 'a-btn-create']) }} title="Guardar" wire:click="store({{$param}})">
    {{ $slot }}
</button>
