<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ContratacionEmpresaController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:empresas.contrataciones.index')->only('index');
        $this->middleware('can:empresas.contrataciones.create')->only('create');
        $this->middleware('can:empresas.contrataciones.edit')->only('edit');
        $this->middleware('can:empresas.contrataciones.show')->only('show');
        $this->middleware('check.contratacion.empresa.ownership')->only(['show', 'edit']);
        $this->middleware('check.plan.creditos')->only('create');
        $this->middleware('check.contratacion.edit')->only('edit');
    }

     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('empresas.contrataciones.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
        return view('empresas.contrataciones.show', compact('contratacionId'));
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
     * Se reemplaza el metodo por otro igual en EmpresaContratacionEdit
     */
    /* public function update(Request $request, Contratacion $contratacion)
    {
        //
    } */

    /**
     * Remove the specified resource from storage.
     * Se reemplaza el metodo por otro igual en EmpresaContratacionShow y en EmpresaContratacionIndex
     */
    /* public function destroy(Contratacion $contratacion)
    {
        //
    } */
}
