<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComidaController;
use App\Models\Pedido;
use App\Http\Controllers\PedidoController;


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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('comida', ComidaController::class);
Route::post('/comida/calculate', [ComidaController::class, 'calculate'])->name('comida.calculate');
Route::post('/comida/guardar_pedidos', [ComidaController::class, 'guardarPedido'])->name('comida.guardarpedido');
Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');





