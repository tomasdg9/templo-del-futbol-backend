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
        
        $det_pedidos = DetallePedido::all();
        
        return view('detalle_pedidos.index'); 
   }
}
