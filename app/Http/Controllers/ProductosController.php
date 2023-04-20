<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

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
        
        $productos = Producto::join('categorias', 'productos.categoria_id', '=', 'categorias.id')
        ->select('productos.*', 'categorias.nombre as categoria_nombre')
        ->get();

         return view('productos.index', ['productos' => $productos]); 
   }

   public function show(string $id)
   {
       $producto = Producto::join('categorias', 'productos.categoria_id', '=', 'categorias.id')
       ->select('productos.*', 'categorias.nombre as categoria_nombre')
       ->where('productos.id', $id) //con el where ya filtra por el id del producto y no hace falta obtenerlo con un find
       ->first();

       return view('productos.show', ['producto' => $producto]);
   }

   public function update(Request $request, String $id){
       $producto = Producto::find($id);

        $producto->nombre = $request->nombre;        
        $producto->precio = $request->precio;
        $producto->activo = $request->activo;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->estado = $request->estado;
        $producto->save();
        return redirect()->route('productos.show', ['producto' => $producto->id])->with('success', 'Producto actualizado con éxito');
   }

   public function destroy(string $id){
        $producto = Producto::find($id);
        $nombre_producto = $producto->nombre;
        $producto->delete();
        return redirect()->route('producto.index')->with('success', 'Producto '.$nombre_producto.' eliminado con éxito');
   }

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required|unique:productos|max:55',
            'precio' => 'required|max:13',
            'activo' => 'required',
            'stock' => 'required',
            'descripcion' => 'max:500',
            'estado' => 'required|max:20'
        ]);

        $producto = new Producto;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->activo = $request->activo;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->estado = $request->estado;
        $producto->save();
        return redirect()->route('productos.index')->with('success', 'El producto '.$producto->nombre.' fue creado con éxito.');
   }

}
