<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
//use Illuminate\Http\Request;
use App\Http\Requests\EmpresaRequest;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresas = Empresa::all();
        return view('empresas.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmpresaRequest $request)
    {
        // Crear una nueva instancia de Empresa
        $empresa = new Empresa();
        $empresa->fill(
            $request->all()
        );
        // Asigna más campos según sea necesario

        // Guardar la empresa en la base de datos
        $empresa->save();

        // Redirigir al usuario a la vista de detalles de la empresa recién creada
        return redirect()->route('empresas.show', $empresa->id)->with('success', 'La empresa ha sido creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $empresa = Empresa::findOrFail($id);
        return view('empresas.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $empresa = Empresa::findOrFail($id);
        return view('empresas.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmpresaRequest $request, $id)
    {
        $empresa = Empresa::findOrFail($id);

        // Actualizar los detalles de la empresa
        $empresa->update([
            'nom_com' => $request->nom_com,
            'domicilio' => $request->domicilio,
            'rubro' => $request->rubro,
            // Actualiza más campos según sea necesario
        ]);

        // Redirigir al usuario a la vista de detalles de la empresa actualizada
        return redirect()->route('empresas.show', $empresa->id)->with('success', 'Los detalles de la empresa han sido actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->delete();
        return redirect()->route('empresas.index')->with('success', 'Empresa eliminada correctamente.');
    }
}
