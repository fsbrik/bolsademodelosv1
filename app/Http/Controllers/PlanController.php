<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // se hace la verificacion en planes.index para saber qué componente de livewire se debe cargar.
        // Si el user es admin, se carga admin.habilitar-planes.
        // Si el user es empresa, se carga plan-index 
        return view('planes.index');        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('planes.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // Se usa el modelo Pedido ya que el plan seleccionado es un pedido con sub_cat = planes
    public function show(Pedido $pedido)
    {
        return view('planes.show', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Se usa el modelo Pedido ya que el plan seleccionado es un pedido con sub_cat = planes
    public function edit(Pedido $pedido)
    {
        return view('planes.edit', compact('pedido'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $plan)
    {
        //
    }
}
