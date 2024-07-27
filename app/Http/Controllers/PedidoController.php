<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:pedidos.index')->only('index');
        $this->middleware('can:pedidos.create')->only('create', 'store');
        $this->middleware('can:pedidos.edit')->only('edit', 'update');
        $this->middleware('can:pedidos.show')->only('show');
        $this->middleware('can:pedidos.destroy')->only('destroy');
        $this->middleware('check.pedido.ownership')->only(['show', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        return view('pedidos.index');
    }

    public function create()
    {
        $users = User::all();
        $servicios = Servicio::all();
        return view('pedidos.create', compact('users', 'servicios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'servicios' => 'required|array',
            'servicios.*.id' => 'required|exists:servicios,id',
            'servicios.*.cantidad' => 'required|integer|min:1',
        ]);

        $pedido = Pedido::create([
            'user_id' => $request->user_id,
            'fecha' => $request->fecha,
            'total' => 0,
        ]);

        $total = 0;

        foreach ($request->servicios as $servicio) {
            $pedido->servicios()->attach($servicio['id'], ['cantidad' => $servicio['cantidad']]);
            $servicioData = Servicio::findOrFail($servicio['id']);
            $total += $servicioData->precio * $servicio['cantidad'];
        }

        $pedido->total = $total;
        $pedido->save();

        return redirect()->route('pedidos.index')->with('success', 'Pedido creado con éxito.');
    }

    public function show(Pedido $pedido)
    {
        return view('pedidos.show', compact('pedido'));
    }

    public function edit(Pedido $pedido)
    {
        return view('pedidos.edit', compact('pedido'));
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado correctamente.');
    }
}
