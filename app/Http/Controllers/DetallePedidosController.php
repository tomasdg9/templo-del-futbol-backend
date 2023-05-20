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
	  $detalle_pedidos = Pedido::orderBy('id', 'asc')->skip(10*$pageAux)->take(10)->get();
      $detalle_pedidosProx = Pedido::orderBy('id', 'asc')->skip(10*($pageAux+1))->take(10)->get(); // probar take(1)
      $tieneProx = (count($detalle_pedidosProx) > 0);
      return view('pedidos.index', ['detalle_pedidos' => $detalle_pedidos, 'page' => $page, 'tieneProx' => $tieneProx]);
  }


   public function show(string $id){
    $pedido = Pedido::find($id); // Busca el pedido con id=$id
    $productos = $pedido->productos; // Busca los productos de ese pedido.
        return view('pedidos.show', ['detalle_pedido' => $pedido, 'productos' =>$productos]);
   }
}