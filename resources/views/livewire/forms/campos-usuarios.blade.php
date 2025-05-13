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
    public $disabled; // para deshabilitar o no los campos del formulario dependiendo si la vista es create, show o edit
    public $hidden = [];

    public function mount($userId, $disabled, $tipoDeRuta)
    {
        $this->userOriginal = User::findOrFail($userId);
        $this->user->fill($this->userOriginal->toArray()); // Cargar los valores del modelo en el Form Object
        $this->user->boot($this->userOriginal); // bootea el usuario para evitar mails duplicados
        $this->mostrarBotones($tipoDeRuta); // mostrar botones dependiendo la ruta
        $this->habilitarCampos($tipoDeRuta); // habilitar campos del form dependiendo la ruta
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

    // este método setea los botones en hidden o no dependiendo la ruta
    public function mostrarBotones($tipoDeRuta)
    {
        switch ($tipoDeRuta) {
            case 'edit':
                $this->hidden = ['', 'hidden', 'hidden', '', ''];
                break;
            case 'show':
                $this->hidden = ['hidden', '', '', 'hidden', ''];
                break;
        }
    }

    // este método setea los inputs del form en disable o no dependiendo la ruta
    public function habilitarCampos($tipoDeRuta)
    {
        switch ($tipoDeRuta) {
            case 'edit':
                $this->disabled = '';
                break;
            case 'show':
                $this->disabled = 'disabled';
                break;
        }
    }

    public function show()
    {
        $this->mostrarBotones('show');
        $this->habilitarCampos('show');
    }
    
    public function edit()
    {
        $this->mostrarBotones('edit');
        $this->habilitarCampos('edit');
    }

    public function destroy()
    {
        $this->userOriginal->delete();
        session()->flash('errorMessage', 'Se eliminó al usuario ' . $this->userOriginal->name);
        return redirect()->route('users.index');
    }

    public function update()
    {
        $this->user->boot($this->userOriginal); //comprueba que el email no este registrado por otro usuario
        $this->validate();
        $this->userOriginal->update($this->user->all());
        $this->dispatch('mostrar-alerta', tipo: 'success', mensaje: 'Se actualizó al usuario ' . $this->userOriginal->name);
    }
}; ?>

<div class="flex flex-wrap justify-start gap-x-4">

    @livewire('forms.foto-perfil', ['userId' => $userOriginal->id])



    <div class="campos-container w-auto flex-initial">

        <!-- Nombre y apellido -->
        <x-field span=6>
            <x-label for="name" value="{{ __('Nombre y apellido') }}" />
            <x-input id="name" type="text" wire:model="user.name" :disabled="$disabled" :class="$disabled" />
        </x-field>

        <!-- Teléfono -->
        <x-field span=6>
            <x-label for="telefono" value="{{ __('Teléfono') }}" />
            <x-input id="telefono" type="text" wire:model="user.telefono" :disabled="$disabled" :class="$disabled" />
        </x-field>

        <!-- E-mail -->
        <x-field span=6>
            <x-label for="email" value="{{ __('E-mail') }}" />
            <x-input id="email" type="text" wire:model="user.email" :disabled="$disabled" :class="$disabled" />
        </x-field>

        <x-field span=12>
            <x-validation-errors class="my-2"></x-validation-errors>

            <div class="buttons-container">
                <x-cards.button-show :param="$userOriginal->id" :hidden="$hidden[0]"/>
                <x-cards.button-edit route="users.edit" :param="$userOriginal->id" :hidden="$hidden[1]"/>
                <x-cards.button-delete :param="$userOriginal->id" tipo="al usuario {{ $userOriginal->name }}" :hidden="$hidden[2]"/>
                <x-cards.button-update :param="$userOriginal->id" :hidden="$hidden[3]"/>
                <x-cards.button-a route="users.index" :hidden="$hidden[4]">{{ __('Volver') }}</x-cards.button-a>
            </div>
        </x-field>
    </div>

</div>
