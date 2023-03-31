<?php

namespace Database\Factories;

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
        return [
            'nombre' => $this->faker->name(),
            'precio' => $this->faker->randomFloat(2),
            //'stock' => $this->faker->randomNumber(2, false),
            'descripcion' => $this->faker->text(),
            'estado' => $this->faker->word(),
            'categoria_nombre' => $categoria->nombre(),
            'categoria_id' => $categoria->id(),
        ];
    }
}
