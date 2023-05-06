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

            $table->string('nombre',55)->unique();
            $table->decimal('precio',10,2);
            $table->boolean('activo');
            $table->unsignedInteger('stock');
            $table->text('descripcion')->nullable();
            $table->string('estado', 20);
            $table->text('imagen');

            // Llave foranea.
            $table->foreignId('categoria_id')->constrained()->onDelete('cascade');
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
