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

    /* Los productos pueden ser mostrados, modificados creados o eliminados.*/
   public function index()
   {
        
        $productos = Producto::all();
        
         return view('productos.index', ['productos' => $productos]); 
   }

   public function show(string $id)
   {
       $producto = Producto::find($id);
       return view('productos.show', ['producto' => $producto]);
   }
/*
   public function update(Request $request, string $id)
   {
       $cliente = Pedido::find($cliente);
       $cliente->email = $request->email;
       $cliente->descripcion = $cliente->descripcion;
       $cliente->save();
       return redirect()->route('cliente.index')->with('success', 'Cliente actualizado con éxito');
   }
   public function destroy(string $id)
   {
       $cliente = Pedido::find($cliente);
       $cliente->delete();
       return redirect()->route('cliente.index')->with('success', 'Cliente eliminado con éxito');
   }


     /*
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
    */
}
