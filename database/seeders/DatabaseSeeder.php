<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        App\Models\User::factory(10)->create();
        App\Models\Categoria::factory(20)->create();
        App\Models\DetallePedido::factory(50)->create();
        App\Models\Pedido::factory(1000)->create();
        App\Models\Producto::factory(250)->create();
        /* -- Agregar reportes -- */
    }
}
