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
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->integer('rut_alumno')->unique(); // R1.1: entero [1000000, 60000000]
            $table->string('nombre_alumno', 100)->index(); // R1.2: string máximo 100 caracteres con índice
            $table->string('correo_alumno', 255)->unique(); // R1.3: alfanuméricos [1,255] único
            $table->timestamps();
            
            // Índice compuesto para consultas frecuentes
            $table->index(['rut_alumno', 'created_at']);
            
            // Comentarios para documentar los requisitos
            $table->comment('Tabla de alumnos según requisitos R1.1, R1.2, R1.3');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
