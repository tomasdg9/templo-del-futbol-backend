<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AssignPermissionsToRoles extends Migration
{
    public function up()
    {
        // Obtener permisos

        $eliminarProductos = Permission::where('name', 'Eliminar productos')->first();
        $crearCategorias = Permission::where('name', 'Crear categorias')->first();
        $eliminarCategorias = Permission::where('name', 'Eliminar categorias')->first();
        $modificarCategorias = Permission::where('name', 'Modificar categorias')->first();
        $subirDeRango = Permission::where('name', 'Subir de rango')->first();

        // Obtener roles
        $administrador = Role::where('name', 'Administrador')->first();
        $superModerador = Role::where('name', 'Super moderador')->first();
        $moderador = Role::where('name', 'Moderador')->first();

        // Asignar permisos a roles
        $administrador->givePermissionTo($eliminarProductos, $crearCategorias, $eliminarCategorias, $modificarCategorias, $subirDeRango);
        $superModerador->givePermissionTo($crearCategorias, $modificarCategorias);
        $moderador->givePermissionTo($modificarCategorias);
    }

    public function down()
    {
    }
}
