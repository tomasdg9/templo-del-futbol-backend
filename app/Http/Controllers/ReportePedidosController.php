<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DetallePedido;
use Illuminate\Http\Request;
use App\Models\Pedido;

class ReportePedidosController extends Controller
{
    public function index(){
        return view('rpedidos.index', ['pedidos' => []]); 
    }

    public function store(Request $request){
        $pedidos = DetallePedido::whereBetween('created_at', [$request->start, $request->finish])->get();
        return view('rpedidos.index', ['pedidos' => $pedidos]);
    }

}
