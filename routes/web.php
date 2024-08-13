<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServicioController;
use App\Livewire\ModeloEstado;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('/users', UserController::class)->except('create', 'store')->names('users');
    Route::view('empresas/contrataciones', 'empresas.contrataciones')->name('empresas.contrataciones');
    Route::resource('/empresas', EmpresaController::class)->names('empresas');
    Route::view('/modelos/cambiar_estado', 'modelos.cambiar_estado')->name('modelos.cambiar_estado');
    Route::resource('/modelos', ModeloController::class)->names('modelos');
    
    Route::middleware(['auth', 'check.if.user.has.modelo'])->group(function () {
        Route::get('/modelos/create', [ModeloController::class, 'create'])->name('modelos.create');
        Route::post('/modelos', [ModeloController::class, 'store'])->name('modelos.store');
    }); 
    Route::view('solicitudes-modelos', 'solicitudes.solicitudes-modelos')->name('solicitudes_modelos');
    Route::resource('/pedidos', PedidoController::class)->names('pedidos');
});

Route::resource('/servicios', ServicioController::class)->names('servicios');
