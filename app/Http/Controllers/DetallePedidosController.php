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
        return redirect()->route('pedidos.indexPage', ['page' => 1]);
     }

    public function indexPage(int $page){
      $pageAux = $page - 1;
      $detalle_pedidos = DetallePedido::orderBy('id', 'asc')->skip(10*$pageAux)->take(10)->get();
      $detalle_pedidosProx = DetallePedido::orderBy('id', 'asc')->skip(10*($pageAux+1))->take(10)->get();
      $tieneProx = (count($detalle_pedidosProx) > 0);
      return view('pedidos.index', ['detalle_pedidos' => $detalle_pedidos, 'page' => $page, 'tieneProx' => $tieneProx]);
  }


   public function show(string $id){
    $detalle_pedido = DetallePedido::find($id);
    $productos = $detalle_pedido->pedido->productos;
    return view('pedidos.show', ['detalle_pedido' => $detalle_pedido, 'productos' =>$productos]);
   }
}
