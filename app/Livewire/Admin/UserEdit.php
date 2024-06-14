<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class UserEdit extends Component
{
    public $user, $id;

    public function mount($id)
    {
        $user = User::findOrFail($id);
        $this->user = $user->toArray();
        $this->id = $id;
    }

    public function updateUser()
    {
        
        $this->validate([
            'user.name' => 'required|string|max:255', // Nombre del usuario
            'user.telefono' => 'required|string|max:20', // Número de teléfono del usuario
            'user.email' => 'required|email|max:255', // Correo electrónico del usuario
        ]);
    
        $existingUser = User::where('email', $this->user['email'])->where('id', '!=', $this->id)->first();
    
        if ($existingUser) {
            //return back()->withErrors(['user.email' => 'El correo electrónico ya está siendo utilizado por otro usuario.'])->withInput();
            return redirect()->route('users.edit', $this->id)->with('error', 'El correo electrónico ya está siendo utilizado por otro usuario.');
        }

        $user = User::findOrFail($this->id);
        $user->update($this->user);

        session()->flash('message', 'Usuario actualizado con éxito!');
        return redirect()->route('users.show', $this->id);
        // Restablecer el estado del componente para recargar la página
        //$this->reset();
    }

    public function render()
    {
        return view('livewire.admin.user-edit');
    }
}
