<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reporte_pedidos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre_reporte');
            $table->date('fecha_inicio')->unique();
            $table->date('fecha_fin')->unique();
            $table->decimal('recaudado', 10, 2);

           // Hay que hacer una tabla que relacione a ReportePedidos con DetallePedido ya que un ReportePedido tiene asociados muchos DetallePedido (productos) y un producto puede estar asociado a muchos Reportes
           // ya que se podria crear un reporte de todo febrero, y otro de febrero y marzo. "Contenido-Reporte" se podría llamar
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reporte_pedidos');
    }
};
