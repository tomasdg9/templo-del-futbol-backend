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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->decimal('precio',10,2);//->unique();
            $table->string('nombre',55)->unique();
            //$table->unsignedInteger('stock');
            $table->text('descripcion');
            $table->string('estado', 20);
            
            $table->foreignId('categoria_nombre')->constrained();
            $table->foreignId('categoria_id')->constrained();

            $table->foreign('categoria_nombre')->references('nombre')->on('categorias')->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade')->onUpdate('cascade'); 
             
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
