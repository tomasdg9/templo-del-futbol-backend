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

            // Llaves foraneas
            //$table->foreignId('categoria_id')->constrained(); no hace falta obtenerlo, ya que se obtiene producto id y con este se obtiene el id de la categoria
            $table->foreignId('producto_id')->constrained();
            $table->foreignId('pedido_id')->constrained();
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade')->onUpdate('cascade');


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
