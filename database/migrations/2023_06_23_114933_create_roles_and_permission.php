<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    public function up()
    {
        // crear roles
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Super moderador']);
        Role::create(['name' => 'Moderador']);

        // Crear permisos
        Permission::create(['name' => 'Eliminar productos']);
        Permission::create(['name' => 'Crear categorias']);
        Permission::create(['name' => 'Eliminar categorias']);
        Permission::create(['name' => 'Modificar categorias']);
        Permission::create(['name' => 'Subir de rango']);
    }

    public function down()
    {
        Schema::dropIfExists('permissions');
    }
};
