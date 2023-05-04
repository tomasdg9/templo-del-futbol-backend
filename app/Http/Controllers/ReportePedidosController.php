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
        return view('rpedidos.index', ['pedidos' => $pedidos]); 
    }

    public function store(Request $request){
        $pedidos = DetallePedido::whereBetween('created_at', [$request->start, $request->finish])->get();
        return redirect()->route('rpedidos.index')->with('pedidos', $pedidos);
    }

}
