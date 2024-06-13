<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
//use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();

        $user->fill(
            $request->all()
        );

        $user->save();

        // Redirigir al usuario a la vista de detalles de la user recién creada
        return redirect()->route('users.show', $user->id)->with('success', 'El usuario ha sido creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Actualizar los detalles del usuario
        $user->update(
            $request()->all()
        );

        // Redirigir al usuario a la vista de detalles de la user actualizada
        return redirect()->route('users.show', $user->id)->with('success', 'Los detalles de la user han sido actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'usuario eliminado correctamente.');
    }
}
