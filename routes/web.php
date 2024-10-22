<?php

use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ReportePedidosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DetallePedidosController;
use App\Http\Controllers\ReporteProductosController;
use App\Http\Controllers\EstadisticasController;
use App\Http\Controllers\UserController;

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


Route::resource('clientes', ClientesController::class)->middleware('auth');
Route::get('/clientes/page/{page}', [ClientesController::class, 'indexPage'])->name('clientes.indexPage')->middleware('auth');
Route::post('/clientes/search', [ClientesController::class, 'searchByName'])->name('clientes.searchByName')->middleware('auth');
Route::get('/clientes/search/1', 'App\Http\Controllers\ClientesController@indexSearch')->name('clientes.indexSearch')->middleware('auth');


Route::resource('categorias', CategoriasController::class)->middleware('auth');
Route::get('/categorias/page/{page}', [CategoriasController::class, 'indexPage'])->name('categorias.indexPage')->middleware('auth');
Route::post('/categorias/search', [CategoriasController::class, 'searchByName'])->name('categorias.searchByName')->middleware('auth');
Route::get('/categorias/search/1', 'App\Http\Controllers\CategoriasController@indexSearch')->name('categorias.indexSearch')->middleware('auth');

Route::resource('rproductos', ReporteProductosController::class)->middleware('auth');
Route::get('/rproductos/page/{page}', [ReporteProductosController::class, 'indexPage'])->name('rproductos.indexPage')->middleware('auth');
Route::get('/rproductos/page/1', [ReporteProductosController::class, 'indexPage'])->name('rproductos.principio')->middleware('auth');

Route::resource('productos', ProductosController::class)->middleware('auth');
Route::get('/productos/page/{page}', [ProductosController::class, 'indexPage'])->name('productos.indexPage')->middleware('auth');
Route::get('/productos/page/1', [ProductosController::class, 'indexPage'])->name('productos.principio')->middleware('auth');
Route::post('/productos/search', [ProductosController::class, 'searchByName'])->name('productos.searchByName')->middleware('auth');
Route::get('/productos/search/1', 'App\Http\Controllers\ProductosController@indexSearch')->name('productos.indexSearch')->middleware('auth');

Route::get('/pedidos/page/{page}', [DetallePedidosController::class, 'indexPage'])->name('pedidos.indexPage')->middleware('auth');
Route::get('/pedidos/page/1', [DetallePedidosController::class, 'indexPage'])->name('pedidos.principio')->middleware('auth');
Route::resource('pedidos', DetallePedidosController::class)->middleware('auth');

Route::resource('rpedidos', ReportePedidosController::class)->middleware('auth');

Route::get('/rpedidos/page/{inicio}/{fin}/{page}', 'App\Http\Controllers\ReportePedidosController@showPage')->middleware('auth');
Route::get('/rproductos/page/{inicio}/{fin}/{page}', 'App\Http\Controllers\ReporteProductosController@showPage')->middleware('auth');

Route::get('/users/1/edit')->middleware('can:ninguno'); //esto se hace para que ningun usuario (ni el mismo admin) pueda cambiar los permisos del admin que tiene el id 1 
Route::resource('users', UserController::class)->middleware('auth');

// Login
Route::get('/', function () {
    if (Auth::check()) { //Si ya inició sesión y quiere ir a la ruta raíz, se re-direcciona al principio.
        return redirect()->route('productos.principio');
    } else { // Si no, lo forza a iniciar sesión.
        return view('auth.login');
    }
})->name('login');


Route::get('/home', function(){
    return redirect()->route('productos.principio');
});

require __DIR__.'/auth.php';
