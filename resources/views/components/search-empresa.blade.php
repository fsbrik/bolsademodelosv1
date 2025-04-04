<div class="w-2/3 mx-auto bg-gray-100 grid grid-cols-6 gap-2 mb-4 p-4">
    <div class="col-span-6 sm:col-span-3">
        <x-label for="searchComercial" value="{{ __('Nombre comercial') }}" />
        <x-input id="searchComercial" type="text" class="mt-1 block w-full"
            wire:model.live.debounce.250ms="searchComercial" />
    </div>
    <div class="col-span-6 sm:col-span-3">
        <x-label for="searchCuit" value="{{ __('Cuit') }}" />
        <x-input id="searchCuit" type="text" class="mt-1 block w-full"
            wire:model.live.debounce.250ms="searchCuit" />
    </div>
</div>