<?php

namespace Database\Seeders;
use App\Models\DetallePedido;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetallePedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetallePedido::factory()
            ->count(200)
            ->create();
    }
}
