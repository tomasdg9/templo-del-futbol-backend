<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DetallePedido;
use Illuminate\Http\Request;

class DetallePedidosController extends Controller
{
    /**
     * index para mostrar todos los productos
     * store para guardar un producto
     * update para actualizar
     * destroy para eliminar
     * edit para mostrar el formulario de edicion
     */

    /* Los productos pueden ser mostrados, modificados creados o eliminados.*/
   public function index()
   {
        
        $detalle_pedidos = DetallePedido::join('pedidos', 'detalle_pedidos.pedido_id', '=', 'pedidos.id')
        ->join('productos', 'detalle_pedidos.producto_id', '=', 'productos.id')
        ->select('detalle_pedidos.*', 'pedidos.email as cliente_email', 'productos.nombre as producto_nombre')
        ->get();

        return view('detalle_pedidos.index', ['detalle_pedidos' => $detalle_pedidos]); 
   }

   public function show(string $id){
    $detalle_pedido = DetallePedido::join('pedidos', 'detalle_pedidos.pedido_id', '=', 'pedidos.id')
    ->join('productos'. 'detalle_pedidos.producto_id', '=', 'productos.id')
    ->select('detalle_pedidos.*', 'pedidos.email as cliente_email', 'productos.nombre as producto_nombre')
    ->where('pedidos.id', $id) //con el where ya filtra por el id del pedido y no hace falta obtenerlo con un find
    ->first();

    return view('detalle_pedidos.show', ['detalle_pedido' => $detalle_pedido]);
   }
}
