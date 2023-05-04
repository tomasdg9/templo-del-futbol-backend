<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\EstadisticasController;

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

Route::get('/estadisticas', EstadisticasController::class . '@index')->middleware('auth')->name('principio');

Route::resource('clientes', ClientesController::class)->middleware('auth');
Route::get('/clientes/page/{page}', [ClientesController::class, 'indexPage'])->name('clientes.indexPage');
Route::post('/clientes/search', [ClientesController::class, 'searchByName'])->name('clientes.searchByName');


Route::resource('categorias', CategoriasController::class)->middleware('auth');
Route::get('/categorias/page/{page}', [CategoriasController::class, 'indexPage'])->name('categorias.indexPage');
Route::post('/categorias/search', [CategoriasController::class, 'searchByName'])->name('categorias.searchByName');


// Login
Route::get('/', function () {
    if (Auth::check()) { //Si ya inició sesión y quiere ir a la ruta raíz, se re-direcciona al principio.
        return redirect()->route('principio');
    } else { // Si no, lo forza a iniciar sesión.
        return view('auth.login');
    }
})->name('login');

Route::get('/home', function(){
    return redirect()->route('principio');
});

require __DIR__.'/auth.php';
