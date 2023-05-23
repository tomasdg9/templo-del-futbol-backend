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
        $tieneProx = session('tieneProx', "");
        $page = session('page', "");
        $inicio = session('inicio', "");
        $fin = session('fin', "");
        return view('rproductos.index', ['productos' => $productos, 'tieneProx' => $tieneProx, 'page' => $page, 'inicio' => $inicio, 'fin' => $fin]);
    }

    public function store(Request $request){
        $request->validate([
            'start' => 'required',
            'finish'=> 'required'
        ]);
        return redirect('/rproductos/page/'.$request->start.'/'.$request->finish.'/1');
    }


    public function showPage($inicio, $fin, $page){
        $pageAux = $page - 1;

        if($page <= 0)
            $pageAux = 0;

        $productos = Producto::where('created_at', '>=', $inicio)
            ->where('created_at', '<=', $fin)
            ->skip($pageAux*10)->take(10)->get();

        $productosProx = Producto::where('created_at', '>=', $inicio)
            ->where('created_at', '<=', $fin)
            ->skip((($pageAux)+1)*10)->take(10)->get();

        $tieneProx = (count($productosProx) > 0);
        return redirect()->route('rproductos.index')->with('productos', $productos)->with('tieneProx', $tieneProx)->with('page', $page)->with('inicio', $inicio)->with('fin', $fin);
    }


}
