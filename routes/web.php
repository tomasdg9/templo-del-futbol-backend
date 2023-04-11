<?php

use App\Http\Controllers\ProductosController;
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
    return view('panel.estadisticas');
});

Route::get('/productos', [ProductosController::class, 'index'])->name('productos');

Route::post('/productos', [ProductosController::class, 'store'])->name('productos');

Route::patch('/productos', [ProductosController::class, 'store'])->name('productos-edit');

Route::delete('/productos', [ProductosController::class, 'store'])->name('productos-destroy');

