<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetallePedido;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class EstadisticasController extends Controller
{
    public function index()
    {
        /* Producto más vendido */
        $productoMasRepetido = DetallePedido::selectRaw('producto_id, COUNT(producto_id) as repeticiones')
            ->groupBy('producto_id')
            ->orderByDesc('repeticiones')
            ->first();
        $productoMasVendido = Producto::find($productoMasRepetido->producto_id);

        /* Ganancias totales */
        $gananciasTotales = 0;
        $pedidos = DetallePedido::all();
        foreach($pedidos as $pedido){
            $producto = Producto::find($pedido->producto_id);
            $gananciasTotales += $producto->precio;
        }

        /* Ganancias del último año -> Array */
        $gananciasAnio = [];
        for ($i = 1; $i <= 12; $i++) {
            $gananciasAnio[$i] = 0;
            $fechaActualMenosUnMes = Carbon::now()->subMonth($i);
            $principio = clone $fechaActualMenosUnMes;
            $principio->startOfMonth();
            $ultimo = clone $fechaActualMenosUnMes;
            $ultimo->endOfMonth();
            $pedidosUltMes = DetallePedido::where('created_at', '>=', $principio)
                                ->where('created_at', '<=', $ultimo)->get();
            foreach($pedidosUltMes as $pedido){
                $gananciasAnio[$i] += Producto::find($pedido->producto_id)->precio;
            }
        }

        /* Ganancias del último mes */
        $gananciasUltimoMes = $gananciasAnio[1];

        /* Cantidad de productos */
        $cantProductos = Producto::all()->count();

        /* Cantidad de pedidos */
        $cantPedidos = Pedido::all()->count();

        /* Cantidad de clientes */
        $cantClientes = Pedido::select('*')->distinct('email')->count();

        /* Cantidad de categorias */
        $cantCategorias = Categoria::all()->count();

        /* Cliente que mas compró */
        $clienteMasCompras = Pedido::selectRaw('email, COUNT(email) as repeticiones')
                           ->groupBy('email')
                           ->orderByDesc('repeticiones')
                           ->first();

        /* Valor promedio de un pedido */
        $valorPromedioPedido = $gananciasTotales;
        $valorPromedioPedido = $valorPromedioPedido / $cantPedidos;

        /* Último pedido */
        $ultimoPedido = Pedido::all()->last();

        return view('estadisticas', [
            'productoMasVendido' => $productoMasVendido,
            'gananciasTotales' => $gananciasTotales,
            'gananciasUltimoMes' => $gananciasUltimoMes,
            'gananciasAnio' => $gananciasAnio,
            'cantProductos' => $cantProductos,
            'cantPedidos' => $cantPedidos,
            'cantClientes' => $cantClientes,
            'cantCategorias' => $cantCategorias,
            'clienteMasCompras' => $clienteMasCompras,
            'valorPromedioPedido' => $valorPromedioPedido,
            'ultimoPedido' => $ultimoPedido
        ]);
    }
}
