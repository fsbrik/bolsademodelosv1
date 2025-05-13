<?php

namespace App\Traits\Searching;

use Livewire\Attributes\On;

trait HasSearching
{

    public $searchTerm;
    public $fechaActual;

    public $searchName, $searchTelefono, $searchEmail;
    public $searchComercial, $searchDomicilio, $searchCuit;

    #[On('actualizarBusqueda')]
    public function actualizarBusqueda($searchTerm)
    {
        $this->searchTerm = $searchTerm;
        $this->resetPage();
    }

    #[On('actualizarBusquedaUsuario')]
    public function actualizarBusquedaUsuario($searchName, $searchTelefono, $searchEmail)
    {
        $this->searchName = $searchName;
        $this->searchTelefono = $searchTelefono;
        $this->searchEmail = $searchEmail;
        $this->resetPage();
    }

    #[On('actualizarBusquedaEmpresas')]
    public function actualizarBusquedaEmpresas($searchComercial, $searchDomicilio, $searchCuit)
    {
        $this->searchComercial = $searchComercial;
        $this->searchDomicilio = $searchDomicilio;
        $this->searchCuit = $searchCuit;
        $this->resetPage();
    }
}