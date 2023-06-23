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
        Permission::create(['name' => 'Borrar actualizar y modificar']);
        Permission::create(['name' => 'Visualizar reportes']);
        Permission::create(['name' => 'Subir de rango']);
        Permission::create(['name' => 'nadie']); //para que nadie pueda modificar el permiso del admin con id 1 (ni el mismo)
    }

    public function down()
    {
        Schema::dropIfExists('permissions');
    }
};
