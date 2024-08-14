<?php

namespace App\Livewire\Admin;

use Livewire\Component;
//use App\Models\User;
use App\Models\Empresa;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


class EmpresaUser extends Component
{
 
    public $user, $empresaId, $photo, $profile_photo_path, $profile_photo_url, $name;
    public $state = [];

    protected function rules()
    {
        return [
            'state.name' => ['required', 'string', 'max:255'],
            'state.email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user->id)],
            'state.telefono' => ['required', 'string', 'max:50'],
            'state.photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ];
    }

    protected $messages = [
        'state.name.required' => 'El nombre es obligatorio.',
        'state.name.string' => 'El nombre debe ser una cadena de texto.',
        'state.name.max' => 'El nombre no puede tener más de 255 caracteres.',
        'state.email.required' => 'El correo electrónico es obligatorio.',
        'state.email.email' => 'El correo electrónico debe ser una dirección válida.',
        'state.email.max' => 'El correo electrónico no puede tener más de 255 caracteres.',
        'state.email.unique' => 'El correo electrónico ya está en uso.',
        'state.telefono.required' => 'El teléfono es obligatorio.',
        'state.telefono.string' => 'El teléfono debe ser una cadena de texto.',
        'state.telefono.max' => 'El teléfono no puede tener más de 50 caracteres.',
        'state.photo.mimes' => 'La foto debe ser un archivo de tipo: jpg, jpeg, png.',
        'state.photo.max' => 'La foto no puede ser mayor a 1MB.',
    ];

    use WithFileUploads;

    public function mount($empresaId)
    {
        $empresa = Empresa::findOrFail($empresaId);
        $this->user = $empresa->user;        
        $this->state = $empresa->user->only('name', 'email', 'telefono');
        $this->profile_photo_url = $empresa->user->profile_photo_url;
        $this->name = $empresa->user->name;
        $this->profile_photo_path = $empresa->user->profile_photo_path;
        $this->empresaId = $empresa->id;
    }

    public function update()
    {

        $this->validate();

        if (isset($this->photo)) {
            $this->user->updateProfilePhoto($this->photo);
        }

        
        $this->user->update($this->state);
    }


    public function updateProfilePhoto()
    {
        // Delete the old photo if it exists
        if ($this->user->profile_photo_path) {
            Storage::disk('public')->delete($this->user->profile_photo_path);
        }

        // Store the new photo and update the user's profile photo path
        $path = $this->photo->store('profile-photos', 'public');
        $this->user->forceFill([
            'profile_photo_path' => $path,
        ])->save();
    }

    public function deleteProfilePhoto()
    {
        if ($this->user->profile_photo_path) {
            Storage::disk('public')->delete($this->profile_photo_path);
            $this->user->forceFill([
                'profile_photo_path' => null,
            ])->save();
            session()->flash('message', 'Profile photo deleted successfully.');
        }
    }

    public function render()
    {
        return view('livewire.admin.empresa-user');
    }
}
