<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;


class ReporteProductosController extends Controller
{
    public function index(){
        $productos = session('productos', []);
        return view('rproductos.index', ['productos' => $productos]);
    }

    public function store(Request $request){
        $productos = Producto::whereBetween('created_at', [$request->start, $request->finish])->get();
        return redirect()->route('rproductos.index')->with('productos', $productos);
    }
    
}
