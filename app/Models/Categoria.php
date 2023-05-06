<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function getCantidadProductos(){
        return $this->productos()->count();
    }
}
