<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function __construct(){
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.edit')->only('edit', 'update');
        $this->middleware('can:users.show')->only('show');
        $this->middleware('can:users.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    /* public function create()
    {
        return view('users.create');
    } */

    /**
     * Store a newly created resource in storage.
     */
    /* public function store(Request $request)
    {
        $user = new User();

        $user->fill(
            $request->all()
        );

        $user->save();

        // Redirigir al usuario a la vista de detalles de la user recién creada
        return redirect()->route('users.show', $user->id)->with('success', 'El usuario ha sido creado correctamente.');
    } */

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Se actualiza en el componenete UserEdit
     */
    /* public function update(Request $request, User $user)
    {
        //$user = User::findOrFail($id);

        // Actualizar los detalles del usuario
        $user->update(
            $request()->all()
        );

        // Redirigir al usuario a la vista de detalles de la user actualizada
        return redirect()->route('users.show', $user->id)->with('success', 'Los detalles de la user han sido actualizados correctamente.');
    } */

    /**
     * Se ejecuta en los componentes index y show
     */
    /* public function destroy(User $user)
    {
        //$user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'usuario eliminado correctamente.');
    } */
}
