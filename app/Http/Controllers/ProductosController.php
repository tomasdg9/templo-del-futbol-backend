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
          return redirect()->route('productos.indexPage', ['page' => 1]);
     }


    // Para llamar a un método del controlador siempre tiene que estar configurado en web.php
    public function indexPage(int $page){
     $pageAux = $page - 1;
     $productos = Producto::orderBy('id', 'asc')->skip(10*$pageAux)->take(10)->get();
     $productosProx = Producto::orderBy('id', 'asc')->skip(10*($pageAux+1))->take(10)->get();
     $tieneProx = (count($productosProx) > 0);
     return view('productos.index', ['productos' => $productos, 'page' => $page, 'tieneProx' => $tieneProx]);
 }

 public function searchByName(Request $request){
    $request->validate([
        'name' => 'required'
    ]);
     $name = $request->input('name');
     $producto = Producto::where('nombre', 'ilike', $name)->first();
     if($producto){
         return redirect()->route('productos.show', ['producto' => $producto->id]);
     } else {
         return redirect()->route('productos.indexPage', ['page' => 1])->with('error', 'El producto no existe');
     }
 }

   public function show(string $id)
   {
     $producto = Producto::find($id);
     $categorias = Categoria::all();
     if($producto)
          return view('productos.show', ['producto' => $producto, 'categorias'=> $categorias]);
     else
          return redirect()->route('productos.indexPage', ['page' => 1])->with('error', 'El producto no existe');
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
          'categoria' => 'required',
          'imagen' => 'required|url'
      ]);

        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->activo = $request->activo;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->estado = $request->estado;
        $producto->imagen = $request->imagen;
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
        return redirect()->route('productos.indexPage', ['page' => 1])->with('success', 'Producto '.$nameproducto.' eliminado con éxito');
   }

    public function store(Request $request){

        $request->validate([
            'nombre' => 'required|min:3|unique:productos|max:55',
            'precio' => 'required|regex:/^\d+(\.\d{1,2})?$/|max:12', //'regex:/^\d+(\.\d{1,2})?$/' es para que valide la entrada decimal
            'activo' => 'required',
            'stock' => 'required|integer',
            'descripcion' => 'max:500',
            'estado' => 'required|max:20',
            'categoria' => 'required',
            'imagen' => 'required|url'
        ]);


        $producto = new Producto;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->activo = $request->activo;
        $producto->categoria_id = $request->categoria;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->estado = $request->estado;
        $producto->imagen = $request->imagen;
        $producto->save();

        return redirect()->route('productos.indexPage', ['page' => 1])->with('success', 'El producto '.$producto->nombre.' fue creado con éxito.');
   }

/**
 * @OA\Get(
 *     path="/rest/productos",
 *     summary="Muestra todos los productos",
 *     @OA\Response(
 *         response=200,
 *         description="Todos los productos")
 * )
 */
   public function showAllByAPI(){
        $productos = Producto::all();
        return response()->json($productos);
   }


/**
 * @OA\Get(
 *     path="/rest/productos/filtrar",
 *     summary="Muestra todos los productos activos",
 *     @OA\Response(
 *         response=200,
 *         description="Todos los productos activos")
 * )
 */
   public function showFilterByAPI(){
        $productos = Producto::where('activo',true)->get();
        return response()->json($productos);
   }
   
/**
 * @OA\Get(
 *     path="/rest/productos/{id}",
 *     summary="Muestra el producto segun su id",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del producto",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Producto segun id")
 *     ,
 *     @OA\Response(
 *         response=404,
 *         description="Producto no encontrado")
 * )
 */
   public function showByAPI(String $id){
        $producto = Producto::find($id);
        if($producto)
            return response()->json($producto);
        else
            return response()->json([
                'mensaje' => 'Producto no encontrado'
            ], 404);
   }
}
