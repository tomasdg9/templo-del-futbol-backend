<?php

use App\Http\Controllers\ProductosController;
use App\Http\Controllers\DetallePedidosController;
use App\Http\Controllers\ReportePedidosController;
use Illuminate\Support\Facades\Route;

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

Route::get('/panel', function(){
    return view('estadisticas');
});

Route::resource('productos', ProductosController::class);
Route::resource('detalle_pedidos', DetallePedidosController::class);
Route::resource('rpedidos', ReportePedidosController::class);