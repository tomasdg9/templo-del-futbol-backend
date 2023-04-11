<?php

namespace Database\Factories;
use App\Models\Pedido;
use App\Models\Producto;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetallePedido>
 */
class DetallePedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $producto = Producto::inRandomOrder()->first();
        $pedido = Pedido::inRandomOrder()->first();
        return [
            'producto_id' => $producto->id,
            'pedido_id' => $pedido->id,
        ];
    }
}
