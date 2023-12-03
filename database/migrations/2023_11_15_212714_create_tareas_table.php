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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->text("descripcion");
            $table->date("fecha_entrega");

            $table->foreignId('proyecto_id')
                ->references('id')
                ->on('proyectos')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('estatus_id')
                ->references('id')
                ->on('tarea_estatuses')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('responsable_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
