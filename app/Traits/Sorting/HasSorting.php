<?php

namespace App\Traits\Sorting;

use Livewire\Attributes\On;

trait HasSorting
{
    public string $sort_by = 'id';
    public string $sortDirection = 'asc';

    #[On('sortBy')]
    public function ordenarPor($sort_by, $sortDirection)
    {
        $this->sort_by = $sort_by;
        $this->sortDirection = $sortDirection;
    }
}
