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
        $productos = Producto::where('created_at', '>=', $request->start)
        ->where('created_at', '<=', $request->finish)
        ->get();
        return redirect()->route('rproductos.index')->with('productos', $productos);
    }
    
}
