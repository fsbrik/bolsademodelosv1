<?php

use App\Livewire\Forms\UserForm;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

new class extends Component {
    use WithFileUploads;

    public UserForm $user;
    public User $userOriginal;
    public $photo;
    public function mount($userId)
    {
        $this->userOriginal = User::findOrFail($userId);
        $this->user->fill($this->userOriginal->toArray()); // Cargar los valores del modelo en el Form Object
    }

    public function updatedPhoto()
    {
        // Eliminar foto anterior si existe
        if ($this->userOriginal->profile_photo_path) {
            Storage::disk('public')->delete($this->userOriginal->profile_photo_path);
        }

        // Guardar nueva foto
        $path = $this->photo->store('profile-photos', 'public');
        $this->userOriginal->profile_photo_path = $path;
        $this->userOriginal->save();
    }

    public function deleteProfilePhoto()
    {
        if ($this->userOriginal->profile_photo_path) {
            Storage::disk('public')->delete($this->userOriginal->profile_photo_path);
            $this->userOriginal->profile_photo_path = null;
            $this->userOriginal->save();
        }
    }

    public function getProfilePhotoUrlProperty()
    {
        return $this->userOriginal->profile_photo_path ? Storage::url($this->userOriginal->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($this->userOriginal->name);
    }
}; ?>

<div class="foto-perfil-container">
        <h4>{{ __('Id de usuario: ') . $userOriginal->id }}</h4>
        <div class="mt-2">
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
                reader.readAsDataURL($refs.photo.files[0]);" />

                    {{-- <x-label for="photo" value="{{ __('Foto') }}" /> --}}

                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="! photoPreview">
                        <img src="{{ $this->profilePhotoUrl }}" alt="{{ $user->name }}"
                            class="rounded-full h-40 w-40 object-cover">
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" x-show="photoPreview" style="display: none;">
                        <span class="block rounded-full w-40 h-40 bg-cover bg-no-repeat bg-center"
                            x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    @can('users.index')
                        <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                            {{ __('Seleccionar una foto nueva') }}
                        </x-secondary-button>

                        @if ($this->userOriginal->profile_photo_path)
                            <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto()">
                                {{ __('Eliminar foto') }}
                            </x-secondary-button>
                        @endif
                    @endcan

                    <x-input-error for="photo" class="mt-2" />
                </div>
            @endif
        </div>
</div>
