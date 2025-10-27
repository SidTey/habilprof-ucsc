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
        Schema::create('logs_sistema', function (Blueprint $table) {
            $table->id();
            $table->integer('rut_alumno')->nullable(); // R1.13: Log de datos cargados
            $table->string('nombre_alumno', 100)->nullable();
            $table->string('correo_alumno', 255)->nullable();
            $table->integer('rut_profesor')->nullable();
            $table->string('nombre_profesor', 100)->nullable();
            $table->string('correo_profesor', 255)->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->decimal('nota_final', 3, 2)->nullable();
            $table->enum('estado', ['exitoso', 'error'])->default('exitoso');
            $table->text('mensaje')->nullable();
            $table->timestamps();
            
            // Índices para optimizar consultas de auditoría
            $table->index(['estado', 'created_at']);
            $table->index(['rut_alumno']);
            $table->index(['rut_profesor']);
            $table->index(['created_at']);
            
            // Para SQLite usamos JSON en lugar de JSONB
            $table->json('datos_adicionales')->nullable();
            
            // Comentarios para documentar los requisitos
            $table->comment('Tabla de logs del sistema según requisito R1.13');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs_sistema');
    }
};
