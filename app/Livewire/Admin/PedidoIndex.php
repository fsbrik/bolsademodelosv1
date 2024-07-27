<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class PedidoIndex extends Component
{
    use WithPagination;

    public $searchTerm;
    public $sort_by = null;
    public $sortDirection = 'asc';
    public $perPage = 3;

    public function updating($field)
    {
        if (in_array($field, [
            'searchTerm'
        ])) {
            $this->resetPage();
        }
    }

    public function sortBy($field)
    {
        if ($this->sort_by === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort_by = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $pedidos = Pedido::with(['user', 'servicios'])
            ->where('id', 'like', '%' . $this->searchTerm . '%')
            ->orWhereHas('user', function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orWhereHas('servicios', function ($query) {
                $query->where('cat_ser', 'like', '%' . $this->searchTerm . '%');
            });
        }
        else {
            $pedidos = Pedido::with('user', 'servicios')->where('user_id', $user->id);
        }

        

        if ($this->sort_by) {
            $pedidos->orderBy($this->sort_by, $this->sortDirection);
        }
        else {
            $pedidos->orderBy('fecha', 'desc');
        }

        $pedidos = $pedidos->paginate($this->perPage);

        return view('livewire.admin.pedido-index', [
            'pedidos' => $pedidos,
        ]);
    }
}
