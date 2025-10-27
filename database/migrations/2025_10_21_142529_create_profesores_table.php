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
        Schema::create('profesores', function (Blueprint $table) {
            $table->id();
            $table->integer('rut_profesor')->unique(); // R1.4: entero [10000000, 60000000]
            $table->string('nombre_profesor', 100)->index(); // R1.5: string máximo 100 caracteres con índice
            $table->string('correo_profesor', 255)->unique(); // R1.7: alfanuméricos [1,255] único
            $table->timestamps();
            
            // Índice compuesto para consultas frecuentes
            $table->index(['rut_profesor', 'created_at']);
            
            // Comentarios para documentar los requisitos
            $table->comment('Tabla de profesores según requisitos R1.4, R1.5, R1.7');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesores');
    }
};
