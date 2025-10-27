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
        Schema::create('registros_ucsc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumno_id')->constrained('alumnos')->onDelete('cascade');
            $table->foreignId('profesor_id')->constrained('profesores')->onDelete('cascade');
            $table->date('fecha_ingreso'); // R1.8: formato DD/MM/AAAA [2025-2050]
            $table->decimal('nota_final', 3, 2)->nullable(); // R1.9: Float [1.00-7.00], opcional
            $table->timestamps();
            
            // Índices para optimizar consultas
            $table->index(['alumno_id', 'fecha_ingreso']);
            $table->index(['profesor_id', 'fecha_ingreso']);
            $table->index(['fecha_ingreso']);
            $table->index(['nota_final']);
            
            // Restricciones de verificación (solo para PostgreSQL)
            // Para SQLite, las validaciones se harán en el modelo
            
            // Comentarios para documentar los requisitos
            $table->comment('Tabla de registros UCSC según requisitos R1.8, R1.9');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros_ucsc');
    }
};
