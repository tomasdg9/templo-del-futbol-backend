<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DetallePedido;
use Illuminate\Http\Request;
use App\Models\Pedido;

class ReportePedidosController extends Controller
{
    public function index(){
        $pedidos = session('pedidos', []);
        $tieneProx = session('tieneProx', "");
        $page = session('page', "");
        $inicio = session('inicio', "");
        $fin = session('fin', "");
        return view('rpedidos.index', ['pedidos' => $pedidos, 'tieneProx' => $tieneProx, 'page' => $page, 'inicio' => $inicio, 'fin' => $fin]);
    }

    public function store(Request $request){
        $request->validate([
            'start' => 'required',
            'finish'=> 'required'
        ]);
        return redirect('/rpedidos/page/'.$request->start.'/'.$request->finish.'/1');
    }

    public function showPage($inicio, $fin, $page){
        $pageAux = $page - 1;

        if($page <= 0)
            $pageAux = 0;

        $pedidos = DetallePedido::where('created_at', '>=', $inicio)
            ->where('created_at', '<=', $fin)
            ->skip($pageAux*10)->take(10)->get();

        $pedidosProx = DetallePedido::where('created_at', '>=', $inicio)
            ->where('created_at', '<=', $fin)
            ->skip((($pageAux)+1)*10)->take(10)->get();

        $tieneProx = (count($pedidosProx) > 0);
        return redirect()->route('rpedidos.index')->with('pedidos', $pedidos)->with('tieneProx', $tieneProx)->with('page', $page)->with('inicio', $inicio)->with('fin', $fin);
    }

}
