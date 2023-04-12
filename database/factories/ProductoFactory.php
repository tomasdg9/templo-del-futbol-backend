<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Categoria;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoria = Categoria::inRandomOrder()->first();
		$usuario = User::inRandomOrder()->first();
        return [
            'nombre' => $this->faker->unique()->name(),
            'precio' => $this->faker->randomFloat(2, 0, 99999999.99),
            'activo' => $this->faker->boolean(),
            'stock' => $this->faker->randomDigit(),
            'descripcion' => $this->faker->text(),
            'estado' => $this->faker->word(),
            'categoria_id' => $categoria->id,
        ];
    }
}
