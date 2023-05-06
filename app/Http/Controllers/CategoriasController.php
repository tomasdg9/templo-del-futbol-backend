<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
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
                Rule::unique('categorias')->ignore($categoria->id),
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

    // Métodos de la API
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

    public function showAllByAPI(){
        $categorias = Categoria::all();
        return response()->json($categorias);
    }

}
