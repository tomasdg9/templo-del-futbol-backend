<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Validation\Rule;

class ProductosController extends Controller
{
    /* Los productos pueden ser mostrados, modificados creados o eliminados.*/
   public function index()
   {
        
        $productos = Producto::all();
        return view('productos.index', ['productos' => $productos]); 
   }

   public function show(string $id)
   {
        $producto = Producto::find($id);
        $productos = Producto::all();

       return view('productos.show', ['producto' => $producto, 'productos' => $productos]);
   }

   public function update(Request $request, String $id){

     $producto = Producto::find($id);
     $request->validate([
          'nombre' => [
               'required',
               'min:3',
               Rule::unique('productos')->ignore($producto->id),
               'max:55'
           ],
          'precio' => 'required|regex:/^\d+(\.\d{1,2})?$/|max:12', //'regex:/^\d+(\.\d{1,2})?$/' es para que valide la entrada decimal
          'activo' => 'required',
          'stock' => 'required|integer',
          'descripcion' => 'max:500',
          'estado' => 'required|max:20',
          'categoria' => 'required'
      ]);

        $producto->nombre = $request->nombre;        
        $producto->precio = $request->precio;
        $producto->activo = $request->activo;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->estado = $request->estado;
        $producto->save();
        return redirect()->route('productos.show', ['producto' => $producto->id])->with('success', 'Producto actualizado con éxito');
   }

   public function create(){
        $productos = Producto::all();
        return view('productos.create', ['productos' => $productos]);
   }

   public function destroy(string $id){
        $producto = Producto::find($id);
        $nameproducto = $producto->nombre;
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto '.$nameproducto.' eliminado con éxito');
   }

    public function store(Request $request){
     
        $request->validate([
            'nombre' => 'required|min:3|unique:productos|max:55',
            'precio' => 'required|regex:/^\d+(\.\d{1,2})?$/|max:12', //'regex:/^\d+(\.\d{1,2})?$/' es para que valide la entrada decimal
            'activo' => 'required',
            'stock' => 'required|integer',
            'descripcion' => 'max:500',
            'estado' => 'required|max:20',
            'categoria' => 'required'
        ]);

        
        $producto = new Producto;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->activo = $request->activo;
        $producto->categoria_id = $request->categoria;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->estado = $request->estado;
        $producto->save();
        return redirect()->route('productos.index')->with('success', 'El producto '.$producto->nombre.' fue creado con éxito.');
   }

}
