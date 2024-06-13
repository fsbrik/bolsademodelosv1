<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;
use App\Http\Requests\ModeloRequest;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modelos = Modelo::paginate();
        return view('modelos.index', compact('modelos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $localidades = include(public_path('storage/localidades/localidades.php'));
        return view('modelos.create', compact('localidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModeloRequest $request)
    {
        try {
            $modelo = new Modelo();

            $ultimoModId = Modelo::max('id'); // Obtener el valor más alto de id
            $nuevoModId = ++$ultimoModId; // Incrementar el valor en uno para obtener el siguiente

            $modelo->mod_id = 'mod' . $nuevoModId;
            $modelo->fill(
                $request->all()
            );
            //dd($modelo);
            // Guardar la modelo en la base de datos
            $modelo->save();

            // Redirigir al usuario a la vista de detalles de la modelo recién creada
            return redirect()->route('modelos.show', $modelo->id)->with('success', 'La modelo ha sido creada correctamente.');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return redirect()->route('users.show', $request->user_id)->with('error', $errorMessage);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $localidades = include(public_path('storage/localidades/localidades.php'));
        $modelo = Modelo::findOrFail($id);
        return view('modelos.show', compact('modelo', 'localidades'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $modelo = Modelo::findOrFail($id);
        return view('modelos.edit', compact('modelo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModeloRequest $request, $id)
    {
        $modelo = Modelo::findOrFail($id);

        // Actualizar los detalles de la modelo
        $modelo->update(
            $request()->all()
        );

        // Redirigir al usuario a la vista de detalles de la modelo actualizada
        return redirect()->route('modelos.show', $modelo->id)->with('success', 'Los detalles de la modelo han sido actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $modelo = Modelo::findOrFail($id);
        $modelo->delete();
        return redirect()->route('modelos.index')->with('success', 'modelo eliminada correctamente.');
    }
}
