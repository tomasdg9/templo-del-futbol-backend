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
        Schema::create('detalle_pedidos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('cliente_email',45);
            $table->decimal('producto_precio', 10, 2);
            $table->string('categoria_nombre_producto', 50);

            //$table->foreignId('categoria_id')->constrained(); no hace falta obtenerlo, ya que se obtiene producto id y con este se obtiene el id de la categoria
            $table->foreignId('producto_id')->constrained();

            
            $table->foreign('categoria_nombre_producto')->references('categoria_nombre')->on('productos')->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreign('producto_precio')->references('precio')->on('productos')->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreign('cliente_email')->references('email')->on('pedidos')->onDelete('cascade')->onUpdate('cascade'); 
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_pedidos');
    }
};
