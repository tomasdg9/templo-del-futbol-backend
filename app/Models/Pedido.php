<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'detalle_pedidos', 'pedido_id', 'producto_id');
    }

    public function getCantidadProductos()
    {
        return $this->productos()->count();
    }

}
