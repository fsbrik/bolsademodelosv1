
<div class="w-2/3 mx-auto bg-gray-100 grid grid-cols-9 gap-2 pt-4 px-4">
    <div class="col-span-6 sm:col-span-3">
        <x-label for="searchName" value="{{ __('Nombre / apellido') }}" />
        <x-input id="searchName" type="text" class="mt-1 block w-full"
            wire:model.live.debounce.250ms="searchName" />
    </div>
    <div class="col-span-6 sm:col-span-3">
        <x-label for="searchTelefono" value="{{ __('Teléfono') }}" />
        <x-input id="searchTelefono" type="text" class="mt-1 block w-full"
            wire:model.live.debounce.250ms="searchTelefono" />
    </div>
    <div class="col-span-6 sm:col-span-3">
        <x-label for="searchEmail" value="{{ __('Email') }}" />
        <x-input id="searchEmail" type="text" class="mt-1 block w-full"
            wire:model.live.debounce.250ms="searchEmail" />
    </div>
</div>