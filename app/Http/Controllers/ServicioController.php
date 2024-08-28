<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
//use Illuminate\Http\Request;
use App\Http\Requests\ServicioRequest;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this->middleware('can:servicios.index')->only('index');
        $this->middleware('can:servicios.create')->only('create', 'store');
        $this->middleware('can:servicios.edit')->only('edit', 'update');
        $this->middleware('can:servicios.show')->only('show');
        $this->middleware('can:servicios.destroy')->only('destroy');
    }

    public function index()
    {
        $servicios = Servicio::all();
        return view('servicios.index', compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('servicios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServicioRequest $request)
    {
        $validatedData = $request->validated();
        
        Servicio::create($validatedData);

        return redirect()->route('servicios.index')->with('message', 'Servicio creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Servicio $servicio)
    {
        return view('servicios.show', compact('servicio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicio $servicio)
    {
        return view('servicios.edit', compact('servicio'));
    }

    /**
     * Update the specified resource in storage.
     * El update se hace en el componente ServicioEdit
     */
    /* public function update(ServicioRequest $request, Servicio $servicio)
    {
        //
    } */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
        return redirect()->route('servicios.index')->with('message', 'servicio eliminado correctamente.');
    }
}
