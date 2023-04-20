<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;

    public function producto()
    {
        return $this->belongsTo(Producto::class,'producto_id');
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id'); // Se puede obviar el "pedido_id" porque laravel asocia al [nombre de la funcion]_id
    }

}
