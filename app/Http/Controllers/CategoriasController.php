<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Validation\Rule;

class CategoriasController extends Controller
{
    public function index()
    {
        return redirect()->route('categorias.indexPage', ['page' => 1]);
    }

    // Para llamar a un método del controlador siempre tiene que estar configurado en web.php
    public function indexPage(int $page){
        $pageAux = $page - 1;
        $categorias = Categoria::orderBy('id', 'asc')->skip(6*$pageAux)->take(6)->get();
        $categoriasProx = Categoria::orderBy('id', 'asc')->skip(6*($pageAux+1))->take(6)->get();
        $tieneProx = (count($categoriasProx) > 0);
        if( count($categorias) == 0)
            return redirect()->route('categorias.indexPage', ['page' => 1]);
        else
            return view('categorias.index', ['categorias' => $categorias, 'page' => $page, 'tieneProx' => $tieneProx]);
    }

    public function searchByName(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        $name = $request->input('name');
        $categoria = Categoria::where('nombre', 'ilike', $name)->first();
        if($categoria){
            return redirect()->route('categorias.show', ['categoria' => $categoria->id]);
        } else {
            return redirect()->route('categorias.indexPage', ['page' => 1])->with('error', 'La categoria no existe');
        }
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:categorias|max:255',
            'descripcion' =>'required|max:500',
            'visible' => 'required'
        ]);

        $categoria = new Categoria;
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->visible = $request->visible;
        $categoria->save();
        return redirect()->route('categorias.indexPage', ['page' => 1])->with('success', 'La categoria '.$categoria->nombre.' fue agregada.');
    }
    public function show(string $id)
    {
        $categoria = Categoria::find($id);
        if($categoria)
            return view('categorias.show', ['categoria' => $categoria]);
        else
            return redirect()->route('categorias.indexPage', ['page' => 1])->with('error', 'La categoria no existe');
    }

    public function edit(string $id)
    {
        //
    }
    public function update(Request $request, string $id)
    {
        $categoria = Categoria::find($id);
        $request->validate([
            'nombre' => [
                'required',
                'min:3',
                Rule::unique('categorias')->ignore($categoria->id), //esto se hace para que el nombre pueda ser el mismo que el anterior
                'max:55'
            ],
            'descripcion' =>'max:500',
            'visible' => 'required'
        ]);
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->visible = $request->visible;
        $categoria->save();
        return redirect()->route('categorias.show', ['categoria' => $categoria->id])->with('success', 'Categoria actualizada');
    }

    public function destroy(string $id)
    {
        $categoria = Categoria::find($id);
        $namecategoria = $categoria->nombre;$categoria->delete();
        return redirect()->route('categorias.indexPage', ['page' => 1])->with('success', 'Categoria '.$namecategoria.' eliminada');
    }


/**
 * @OA\Get(
 *     path="/rest/categorias/{id}",
 *     summary="Muestra categorias segun id",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID de la categoria",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Categoría no encontrada"),
 *     @OA\Response(
 *         response=200,
 *         description="Categoría encontrada")
 * )
 */
    public function showByAPI(string $id)
    {
        $categoria = Categoria::find($id);
        if($categoria)
            return response()->json($categoria);
        else
            return response()->json([
                'mensaje' => 'Categoria no encontrada'
            ], 404);
    }

/**
 * @OA\Get(
 *     path="/rest/categorias",
 *     summary="Muestra todas las categorias visibles",
 *
 *     @OA\Response(
 *         response=200,
 *         description="Lista de todas las categorías visibles")
 * )
 */
    public function showAllByAPI(){
        $categorias = Categoria::where('visible', true)->get();
        return response()->json($categorias);
    }

public function searchByAPI(string $name)
    {
		if($name == "")
			$categorias = Categoria::all();
		else
			$categorias = DB::table('categorias')
				->whereRaw("LOWER(SUBSTRING(nombre, 1, LENGTH(?))) = LOWER(?)", [$name, $name])
				->get();
        if($categorias)
            return response()->json($categorias);
        else
            return response()->json([
                'mensaje' => 'Categoria no encontrada'
            ], 404);
    }
	
/**
 * @OA\Get(
 *     path="/rest/categorias/page/{page}",
 *     summary="Muestra las categorias por pagina",
 *     @OA\Parameter(
 *         name="page",
 *         in="path",
 *         description="pagina de la categoria",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Pagina de categorías")
 *     ,
 *     @OA\Response(
 *         response=404,
 *         description="Pagina no encontrada")
 * )
 */
    public function showPageByAPI(string $page){
        $pageAux = $page - 1;
        $categorias = Categoria::orderBy('id', 'asc')->skip(6*$pageAux)->take(6)->get();
        if( count($categorias) == 0)
        return response()->json([
            'mensaje' => 'Página de categorías no encontrada'
        ], 404);
        else
            return response()->json($categorias);
    }

/**
 * @OA\Get(
 *     path="/rest/productos/categoria/{id}",
 *     summary="Muestra los productos de una categoria por id de la categoria",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID de la categoria",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Productos por categoría")
 *     ,
 *     @OA\Response(
 *         response=404,
 *         description="Categoria no encontrada o sin productos")
 *
 * )
 */
    public function getProductosByCategoria(string $id){
        $categoria = Categoria::find($id);
        if($categoria) {
			$productos = Producto::where('categoria_id', $id)->where('activo', true)->get();
			//$productos = $categoria->productos;
            if( count($productos) == 0)
            return response()->json([
                'mensaje' => 'La categoría no tiene productos'
            ], 404);
            else
                return response()->json($productos);
		}
        else
            return response()->json([
                'mensaje' => 'Categoria no encontrada'
            ], 404);
    }

}
