<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServicioController;
//use App\Http\Controllers\ContratacionController;
use App\Http\Controllers\ContratacionEmpresaController;
use App\Http\Controllers\ContratacionModeloController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\PolicyController;



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

Route::get('/', function () {/* return view('welcome'); */  return view('dashboardguest');})->name('dashboardguest');
Route::get('/novedades', function () {/* return view('welcome'); */  return view('novedades');})->name('novedades');
Route::view('/informacion-para-modelos', 'infomodelos')->name('infomodelos');
Route::view('/informacion-para-empresas', 'infoempresas')->name('infoempresas');
Route::view('/servicios-generales', 'serviciosgenerales')->name('serviciosgenerales');
Route::view('/servicios-para-empresas', 'serviciosempresas')->name('serviciosempresas');
Route::view('/servicios-para-modelos', 'serviciosmodelos')->name('serviciosmodelos');
Route::get('/terminos-y-condiciones', [TermsController::class, 'show'])->name('terminos');
Route::get('/politicas-de-privacidad', [PolicyController::class, 'show'])->name('politicas');
Route::get('/modelos', [ModeloController::class, 'index'])->name('modelos.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard');})->name('dashboard');

    Route::resource('/users', UserController::class)->except('create', 'store')->names('users');
    
    Route::resource('/empresas/contrataciones', ContratacionEmpresaController::class)->parameters(['contrataciones' => 'contratacion'])->except('store','update','destroy')->names('empresas.contrataciones');
    Route::resource('/empresas', EmpresaController::class)->names('empresas');

    Route::resource('/modelos/contrataciones', ContratacionModeloController::class)->parameters(['contrataciones' => 'contratacion'])->except('create','store','edit','update','destroy')->names('modelos.contrataciones');
    Route::view('/modelos/cambiar_estado', 'modelos.cambiar_estado')->middleware('check.modelo.estado')->name('modelos.cambiar_estado');
    Route::resource('/modelos', ModeloController::class)->except('index')->names('modelos');
    
    Route::middleware(['auth', 'check.if.user.has.modelo'])->group(function () {
        Route::get('/modelos/create', [ModeloController::class, 'create'])->name('modelos.create');
        Route::post('/modelos', [ModeloController::class, 'store'])->name('modelos.store');
    }); 
    Route::view('/solicitudes-modelos', 'solicitudes.solicitudes-modelos')->middleware('check.solicitudes.modelos')->name('solicitudes_modelos');
    // se coloca parameters para que haga el binding con el modelo Pedido, sino tira un error en el controlador
    Route::resource('/planes', PlanController::class)->parameters(['planes' => 'pedido'])->except('store', 'update', 'destroy')->names('planes');
    Route::resource('/pedidos', PedidoController::class)->names('pedidos');
    Route::resource('/servicios', ServicioController::class)->names('servicios');
});


