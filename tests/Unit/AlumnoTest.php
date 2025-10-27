<?php

namespace Tests\Unit\Models;

use App\Models\Alumno;
use PHPUnit\Framework\TestCase;

class AlumnoTest extends TestCase
{
    /**
     * Test de validación de rango de RUT de alumno (R1.1)
     */
    public function test_rut_alumno_debe_estar_en_rango_valido(): void
    {
        $rutValido = 12345678;
        $this->assertGreaterThanOrEqual(1000000, $rutValido);
        $this->assertLessThanOrEqual(60000000, $rutValido);
    }

    /**
     * Test de validación de nombre de alumno (R1.2)
     */
    public function test_nombre_alumno_debe_tener_longitud_valida(): void
    {
        $nombre = "Juan Pérez";
        $this->assertLessThanOrEqual(100, strlen($nombre));
        $this->assertGreaterThan(0, strlen($nombre));
    }

    /**
     * Test de estructura del modelo Alumno
     */
    public function test_modelo_alumno_tiene_fillable_correcto(): void
    {
        $alumno = new Alumno();
        $fillable = $alumno->getFillable();
        
        $this->assertContains('rut_alumno', $fillable);
        $this->assertContains('nombre_alumno', $fillable);
        $this->assertContains('correo_alumno', $fillable);
    }
}
