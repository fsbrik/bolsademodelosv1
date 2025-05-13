<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\On;

class HabilitarPlanes extends Component
{   

   /*  #[On('success')]
    public function success($successMessage)
    {
        session()->flash('successMessage', $successMessage);
    }

    #[On('error')]
    public function error($errorMessage)
    {
        session()->flash('errorMessage', $errorMessage);
    }     */

    public function render()
    {
        return view('livewire.admin.habilitar-planes'); //, compact('pedidos')
    }
}
