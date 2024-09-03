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
        return view ('empresas.contrataciones');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Contratacion $contratacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contratacion $contratacion)
    {
        //
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
