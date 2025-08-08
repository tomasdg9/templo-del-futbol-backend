<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Notifications\MensajeRecibido;
use Illuminate\Support\Facades\Auth;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductosController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Borrar actualizar y modificar');
    }

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

 public function indexSearch(){
    $productos = session('productos', []);
    $tieneProx = session('tieneProx', "");
    $page = session('page', "");
    $name = session('name',"");
    return view('productos.index', ['productos' => $productos, 'tieneProx' => $tieneProx, 'page' => $page]);
 }

 public function searchByName(Request $request){
    $request->validate([
        'name' => 'required'
    ]);

    $name = $request->input('name');
    $productos = Producto::where('nombre', 'like', '%' . $name . '%')->get();
    if($productos){
        return redirect()->route('productos.indexSearch')->with('productos', $productos);
    } else {
        return redirect()->route('productos.indexPage', ['page' => 1])->with('error', 'No existen productos correspondientes a la busqueda');
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
          'imagen' => 'required|mimes:jpg,png,jpeg|max:2048' // max 2mb y solo jpg, png y jpeg. (modificar para svg, etc?)
      ]);

        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->activo = $request->activo;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->estado = $request->estado;
        
        // Elimina la anterior imagen de Cloudinary.
        $nombreArchivo = basename($producto->imagen);
        $nombreSinExtension = pathinfo($nombreArchivo, PATHINFO_FILENAME); // Obtiene el public id de la imagen anterior.
        Cloudinary::destroy($nombreSinExtension);

        $uploadedFileUrl = Cloudinary::upload($request->file('imagen')->getRealPath())->getSecurePath(); // OPCIONAL: Sube la imagen a Cloudinary.
        $producto->imagen = $uploadedFileUrl;
        $producto->save();
        return redirect()->route('productos.show', ['producto' => $producto->id])->with('success', 'Producto actualizado con éxito');
   }

   public function create(){
        $productos = Producto::all();
        $categorias = Categoria::all();
        return view('productos.create', ['productos' => $productos, 'categorias'=> $categorias]);
   }

   /* Re entrega. No se elimina el producto, simplemente la disponibilidad (atributo "visible") se pone en false.
   public function destroy(string $id){
        $producto = Producto::find($id);
        $nameproducto = $producto->nombre;
        $pedidosConEseProducto = $producto->pedidos;
        $producto->delete();
        // Re entrega -> Cuando se elimina un producto, se busca en los pedidos que tenia asociado. Si un pedido tenia unicamente ese producto asociado, se borra el pedido.
        foreach ($pedidosConEseProducto as $pedido) {
            if($pedido->getCantidadProductos() == 0)
                $pedido->delete();
        }
        return redirect()->route('productos.indexPage', ['page' => 1])->with('success', 'Producto '.$nameproducto.' eliminado con éxito');
   }*/

    public function store(Request $request){

        $request->validate([
            'nombre' => 'required|min:3|unique:productos|max:55',
            'precio' => 'required|regex:/^\d+(\.\d{1,2})?$/|max:12', //'regex:/^\d+(\.\d{1,2})?$/' es para que valide la entrada decimal
            'activo' => 'required',
            'stock' => 'required|integer',
            'descripcion' => 'max:500',
            'estado' => 'required|max:20',
            'categoria' => 'required',
            'imagen' => 'required|mimes:jpg,png,jpeg|max:2048'
        ]);
        $receptor = Auth::user();


        $producto = new Producto;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->activo = $request->activo;
        $producto->categoria_id = $request->categoria;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->estado = $request->estado;
        $uploadedFileUrl = Cloudinary::upload($request->file('imagen')->getRealPath())->getSecurePath(); // OPCIONAL: Sube la imagen a Cloudinary.
        $producto->imagen = $uploadedFileUrl;
        $producto->save();
        $receptor->notify(new MensajeRecibido());

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
 *     summary="Muestra todos los productos activos y que su categoria esté visible",
 *     @OA\Response(
 *         response=200,
 *         description="Todos los productos activos con categoria visible")
 * )
 */
   public function showFilterByAPI(){
        //$productos = Producto::where('activo',true)->get();
        $productos = Producto::where('activo', true)
			->whereHas('categoria', function ($query) {
				$query->where('visible', true);
			})
			->get();
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
    
    if ($producto && $producto->activo == true) {
        $categoria = Categoria::find($producto->categoria_id);
        $nombreCategoria = $categoria->nombre;
        
        $productoData = $producto->toArray();
        $productoData['nombre_categoria'] = $nombreCategoria;
        
        return response()->json($productoData);
    } else {
        return response()->json([
            'mensaje' => 'Producto no encontrado'
        ], 404);
    }
   }
   
   public function searchCategoriaNameByAPI(String $nombre, String $categoria){
			$productos = DB::table('productos')
				->whereRaw("LOWER(SUBSTRING(nombre, 1, LENGTH(?))) = LOWER(?)", [$nombre, $nombre])
				->where('categoria_id', $categoria)->where('activo', true)
				->get();
				
         return response()->json($productos);
   }
   
   public function getMasNuevos() {
    $productos = Producto::where('activo', true)
        ->whereHas('categoria', function ($query) {
            $query->where('visible', true);
        })
        ->orderBy('created_at', 'desc') // Ordenar por fecha de creación en orden descendente
        ->take(4)
        ->get();

    return response()->json($productos);
	}


public function searchByAPI(string $name)
    {
		if($name == "")
			$productos = Producto::all();
		else
			$productos = DB::table('productos')
				->whereRaw("LOWER(SUBSTRING(nombre, 1, LENGTH(?))) = LOWER(?)", [$name, $name])
				->where('activo', true)
				->get();
				
        if($productos)
            return response()->json($productos);
        else
            return response()->json([
                'mensaje' => 'Producto no encontrado'
            ], 404);
    }
	
}
