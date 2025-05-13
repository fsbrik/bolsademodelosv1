<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Traits\Searching\HasSearching;
use App\Models\User;
use Livewire\Attributes\On;

new class extends Component {
    use WithPagination;
    use HasSearching; // trait para los campos de busqueda en la tabla


    // busca el primero que coincida para no sobrecargar la base de datos
    public function queryUser()
    {
        $users = User::query();

        if ($this->searchName) {
            $users->where('name', 'like', '%' . $this->searchName . '%');
        }

        if ($this->searchTelefono) {
            $users->where('telefono', 'like', '%' . $this->searchTelefono . '%');
        }

        if ($this->searchEmail) {
            $users->where('email', 'like', '%' . $this->searchEmail . '%');
        }

        $user = $users->first();

        if((!$this->searchName && !$this->searchTelefono && !$this->searchEmail))
        {
            return null;
        }
        elseif($user != null) 
        {
            // envía el id del usuario seleccionado para asignarselo a la empresa a crear
            $this->dispatch('idUsuarioSeleccionado', idUsuarioSeleccionado: $user->id);  
            return $user;
        }
        
    }

    public function with(): array
    {
        return [
            'user' => $this->queryUser(),
        ];
    }
}; ?>

<div class="border-base-content/25 w-full overflow-x-auto ">
    @if($user)
        <div class="campos-container">
            <!-- Id -->
            <x-field span=4 class="p-1 rounded-md bg-green-400">
                <h2>{{ __('Cambiar el usuario a: '.$user->name) }}</h2>
            </x-field>
        </div>
    @endif
</div>
