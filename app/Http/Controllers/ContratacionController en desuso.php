<?php

namespace App\Http\Controllers;

use App\Models\Contratacion;
use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ContratacionController extends Controller
{

    public function __construct()
    {
        $this->middleware(['can:modelos.contrataciones.index', 'can:empresas.contrataciones.index'])->only('index');
        $this->middleware('can:empresas.contrataciones.create')->only('create');
        $this->middleware('can:empresas.contrataciones.edit')->only('edit');
        $this->middleware(['can:modelos.contrataciones.show', 'can:empresas.contrataciones.show'])->only('show');
    }

     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $view = $this->getViewByRole('index');
        return view($view);
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
        $view = $this->getViewByRole('show');
        return view($view, compact('contratacionId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($contratacionId)
    {
        return view('empresas.contrataciones.edit', compact('contratacionId'));
    }

    // este método se utiliza en index y en show, donde $action puede ser 'index' o 'show'
    private function getViewByRole($action)
    {
        $userRole = Auth::user()->roles->first()->name;

        // Seleccionar la vista correcta basado en el rol y la acción
        if ($userRole == 'empresa') {
            return "empresas.contrataciones.$action";
        } elseif ($userRole == 'modelo') {
            return "modelos.contrataciones.$action";
        }
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
