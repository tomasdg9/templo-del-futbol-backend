<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;

class ProductosController extends Controller
{
    /**
     * index para mostrar todos los productos
     * store para guardar un producto
     * update para actualizar
     * destroy para eliminar
     * edit para mostrar el formulario de edicion
     */

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required|min:3'
        ]);
        
        $producto = new Producto();
        $producto -> nombre = $request -> nombre;
        $producto -> save();

        return redirect()->route('productos')->with('success', 'Producto cargado correctamente');
    }

    public function index(){
        $productos = Producto::all();
        return view('panel.productos', ['productos' => $productos]);
    }

}
