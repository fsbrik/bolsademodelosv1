<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ContratacionModeloController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:modelos.contrataciones.index')->only('index');
        $this->middleware('can:modelos.contrataciones.show')->only('show');
        $this->middleware('check.contratacion.modelo.ownership')->only('show');
    }

     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('modelos.contrataciones.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    /* public function create()
    {
        return view ('empresas.contrataciones.create');
    } */

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
        return view('modelos.contrataciones.show', compact('contratacionId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    /* public function edit($contratacionId)
    {
        return view('empresas.contrataciones.edit', compact('contratacionId'));
    } */

    /**
     * Update the specified resource in storage.
     */
    /* public function update(Request $request, Contratacion $contratacion)
    {
        //
    } */

    /**
     * Remove the specified resource from storage.
     */
    /* public function destroy(Contratacion $contratacion)
    {
        //
    } */
}
