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

            /*
            Si agregamos esto, no habría que borrar timestamp?
            */
            $table->date('fecha_inicio')->unique();
            $table->date('fecha_fin')->unique();
            

            $table->decimal('precio', 10, 2);

            /* Hacer todo esto por foreingId */
            $table->string('categoria_nombre_reporte');
            $table->decimal('producto_precio_detalle', 10, 2);

            $table->foreignId('categoria_id')->constrained(); //se deberia obtener desde detalle_pedidos?
            $table->foreignId('producto_id')->constrained();

            $table->foreign('producto_precio_detalle')->references('producto_precio')->on('detalle_pedidos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('categoria_nombre_reporte')->references('categoria_nombre_producto')->on('detalle_pedidos')->onDelete('cascade')->onUpdate('cascade'); 
            
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
