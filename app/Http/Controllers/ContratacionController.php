<?php

namespace App\Http\Controllers;

use App\Models\Contratacion;
use App\Models\Modelo;
use Illuminate\Http\Request;

class ContratacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        return view ('empresas.contrataciones.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$mod_id = session()->get('modelos_seleccionadas', []);
        return view ('empresas.contrataciones.create');
    }

    /**
     * Store a newly created resource in storage.
     * Se reemplaza el metodo por otro igual en EmpresaContratacionCreate
     */
    /* public function store(Request $request)
    {
        //
    } */

    /**
     * Display the specified resource.
     */
    public function show($contratacionId)
    {
        return view ('empresas.contrataciones.show', compact('contratacionId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($contratacionId)
    {
        return view('empresas.contrataciones.edit', compact('contratacionId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contratacion $contratacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contratacion $contratacion)
    {
        //
    }
}
