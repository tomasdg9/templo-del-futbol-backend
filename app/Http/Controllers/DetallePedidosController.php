<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DetallePedido;
use App\Models\Pedido;
use Illuminate\Http\Request;

class DetallePedidosController extends Controller
{
    
    
    /* Los pedidos pueden ser mostrados.*/
   public function index()
     {
          $detalle_pedidos = DetallePedido::all();
          return view('pedidos.index', ['detalle_pedidos' => $detalle_pedidos]); 
     }

   public function show(string $id){
    $detalle_pedido = DetallePedido::find($id);
    $productos = $detalle_pedido->pedido->productos;
    return view('pedidos.show', ['detalle_pedido' => $detalle_pedido, 'productos' =>$productos]);
   }
}
