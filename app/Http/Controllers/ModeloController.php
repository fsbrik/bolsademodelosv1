<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Modelo;
use Illuminate\Http\Request;
use App\Http\Requests\ModeloRequest;

class ModeloController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:modelos.index')->only('index');
        $this->middleware('can:modelos.create')->only('create', 'store');
        $this->middleware('can:modelos.edit')->only('edit', 'update');
        $this->middleware('can:modelos.show')->only('show');
        $this->middleware('can:modelos.destroy')->only('destroy');
        $this->middleware('check.modelo.ownership')->only(['show', 'edit', 'update', 'destroy']);
    }
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
    public function show(Modelo $modelo)
    {
        //$modelo = Modelo::findOrFail($id);

        $localidades = include(public_path('storage/localidades/localidades.php'));
        return view('modelos.show', compact('modelo', 'localidades'));
    }

    /* public function cambiar_estado(Modelo $modelo){
        return view('modelos.cambiar_estado', compact($modelo));
    } */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modelo $modelo)
    {
        //$modelo = Modelo::findOrFail($id);
        return view('modelos.edit', compact('modelo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModeloRequest $request, Modelo $modelo)
    {
        //$modelo = Modelo::findOrFail($id);

        $modelo->update(
            $request()->all()
        );

        // Redirigir al usuario a la vista de detalles de la modelo actualizada
        return redirect()->route('modelos.show', $modelo->id)->with('success', 'Los detalles de la modelo han sido actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modelo $modelo)
    {
        //$modelo = Modelo::findOrFail($id);

        $modelo->delete();
        return redirect()->route('profile.show')->with('success', 'modelo eliminada correctamente.');
    }
}
