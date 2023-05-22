<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Nette\Utils\ArrayList;

class ReporteProductosController extends Controller
{
    public function index(){
        $productos = session('productos', []);
        return redirect()->route('rproductos.indexPage', ['productos' => $productos, 'page' => 1]);
    }

    public function store(Request $request){
        $request->validate([
            'start' => 'required',
            'finish'=> 'required'
        ]);
        $productos = Producto::where('created_at', '>=', $request->start)
        ->where('created_at', '<=', $request->finish)
        ->get();
        return redirect()->route('rproductos.indexPage', ['page' => 1])->with(['productos'=> $productos]);
    }

    public function indexPage(int $page, Collection $productos)
{
    $productosPaginados = [];
    $tieneProx = false;
    $perPage = 10;
    $pageAux = $page - 1;

    if(count($productos)>0){
        $productosPaginados = $productos->forPage($page, $perPage);
        $productosProx = $productos->forPage($page + 1, $perPage);
        $tieneProx = $productosProx->isNotEmpty();
    }
    
    return view('rproductos.index', [
        'productos' => $productosPaginados,
        'page' => $page,
        'tieneProx' => $tieneProx
    ]);
}
   
    
}
