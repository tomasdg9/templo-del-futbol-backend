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
        $borrarActualizarYModificar = Permission::where('name', 'Borrar actualizar y modificar')->first();
        $visualizarReportes = Permission::where('name', 'Visualizar reportes')->first();
        $subirDeRango = Permission::where('name', 'Subir de rango')->first();

        // Obtener roles
        $administrador = Role::where('name', 'Administrador')->first();
        $superModerador = Role::where('name', 'Super moderador')->first();
        $moderador = Role::where('name', 'Moderador')->first();

        // Asignar permisos a roles
        $administrador->givePermissionTo($borrarActualizarYModificar, $visualizarReportes, $subirDeRango);
        $superModerador->givePermissionTo($visualizarReportes, $borrarActualizarYModificar);
        $moderador->givePermissionTo($borrarActualizarYModificar);
    }

    public function down()
    {
    }
}
