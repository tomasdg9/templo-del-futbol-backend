<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;

class ReportePedidosController extends Controller
{
    public function index(){
        $pedidos = Pedido::all();
        
        return view('rpedidos.index', ['pedidos' => $pedidos]); 
    }
}
