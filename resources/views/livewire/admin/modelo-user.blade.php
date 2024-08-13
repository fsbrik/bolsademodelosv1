<x-action-section>
    <x-slot name="title">
        {{ __('Datos de contacto') }}
    </x-slot>
    <x-slot name="description">
    </x-slot>

    <x-slot name="content">
        <form wire:submit.prevent="update">
            @csrf
            <div class="grid grid-cols-1 md:grid md:grid-cols-3 md:gap-3">
                <div class="col-span-3 sm:col-span-1 sm:row-span-2">
                    <!-- Profile Photo -->
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                            <!-- Profile Photo File Input -->
                            <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
                                x-on:change="
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);
                        " />

                            <x-label for="photo" value="{{ __('Foto') }}" />

                            <!-- Current Profile Photo -->
                            <div class="mt-2" x-show="! photoPreview">
                                <img src="{{ $profile_photo_url }}" alt="{{ $name }}"
                                    class="rounded-full h-20 w-20 object-cover">
                            </div>

                            <!-- New Profile Photo Preview -->
                            <div class="mt-2" x-show="photoPreview" style="display: none;">
                                <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                                    x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                </span>
                            </div>

                            <x-secondary-button class="mt-2 me-2" type="button"
                                x-on:click.prevent="$refs.photo.click()">
                                {{ __('Select A New Photo') }}
                            </x-secondary-button>

                            @if ($this->user->profile_photo_path)
                                <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto()">
                                    {{ __('Remove Photo') }}
                                </x-secondary-button>
                            @endif

                            <x-input-error for="photo" class="mt-2" />
                        </div>
                    @endif
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <x-label for="name" value="{{ __('Nombre y apellido') }}" />
                    <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" />
                    <x-input-error for="state.name" class="mt-2" />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <x-label for="telefono" value="{{ __('Teléfono') }}" />
                    <x-input id="telefono" type="text" class="mt-1 block w-full" wire:model="state.telefono" />
                    <x-input-error for="state.telefono" class="mt-2" />
                </div>

                <div class="col-span-3 sm:col-span-1">
                    <x-label for="email" value="{{ __('E-mail') }}" />
                    <x-input id="email" type="text" class="mt-1 block w-full" wire:model="state.email" />
                    <x-input-error for="state.email" class="mt-2" />
                </div>
            </div>
            <div class="flex items-center justify-end mt-4">
                @if (Auth::user()->hasRole('admin'))
                    <x-button class="ml-4">
                        {{ __('Actualizar') }}
                    </x-button>
                @endcan
        </div>
    </form>
</x-slot>
</x-action-section>
