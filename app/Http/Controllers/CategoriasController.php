<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriasController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
         return view('categorias.index', ['categorias' => $categorias]);
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
        return redirect()->route('categorias.index')->with('success', 'La categoria '.$categoria->nombre.' fue agregada.');
    }
    public function show(string $id)
    {
        $categoria = Categoria::find($id);
        return view('categorias.show', ['categoria' => $categoria]);
    }

    public function edit(string $id)
    {
        //
    }
    public function update(Request $request, string $id)
    {
        $categoria = Categoria::find($id);

        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->visible = $request->visible;
        $categoria->save();
        return redirect()->route('categorias.show', ['categoria' => $categoria->id])->with('success', 'Categoria actualizada');
    }

    public function destroy(string $id)
    {

        $categoria = Categoria::find($id);
        $namecategoria = $categoria->nombre;
        /*$categoria->productos()->each(function($producto) {
           $producto->delete(); // Esto hace que todo producto que tenga esta categoria que se eliminará asociada, se borre, ya que quedará sin categoría.
        }); // Preguntar en la práctica -> ¿Hace falta definir esto? Porque en la migración ya definimos que se borren en cascada.
        */$categoria->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoria '.$namecategoria.' eliminada');
    }
}
