<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'detalle_pedidos');
    }
    public function getCantidadProductos()
    {
        return $this->productos()->count();
    }
    public function getCostoTotal() // Retorna el costo total del pedido.
    {
        $costoTotal = 0;
        $productos = $this->productos;
        foreach($productos as $producto){
            $costoTotal += $producto->precio;
        }
        return $costoTotal;
    }


}
