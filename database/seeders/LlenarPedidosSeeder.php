<?php

namespace Database\Seeders;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\DetallePedido;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LlenarPedidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pedidos = Pedido::all();
        foreach ($pedidos as $pedido) {
            if($pedido->getCantidadProductos() == 0){
                $producto = Producto::inRandomOrder()->first();
                $detallePedido = new DetallePedido;
                $detallePedido->pedido_id = $pedido->id;
                $detallePedido->producto_id = $producto->id;
                $detallePedido->precio = $producto->precio;
                $detallePedido->save();
            }
        }
    }
}
