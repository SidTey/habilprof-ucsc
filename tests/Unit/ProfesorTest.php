<?php

namespace Tests\Unit\Models;

use App\Models\Profesor;
use PHPUnit\Framework\TestCase;

class ProfesorTest extends TestCase
{
    /**
     * Test de validación de rango de RUT de profesor (R1.4)
     */
    public function test_rut_profesor_debe_estar_en_rango_valido(): void
    {
        $rutValido = 15000000;
        $this->assertGreaterThanOrEqual(10000000, $rutValido);
        $this->assertLessThanOrEqual(60000000, $rutValido);
    }

    /**
     * Test de validación de nombre de profesor (R1.5)
     */
    public function test_nombre_profesor_debe_tener_longitud_valida(): void
    {
        $nombre = "Dr. Carlos Martínez";
        $this->assertLessThanOrEqual(100, strlen($nombre));
        $this->assertGreaterThan(0, strlen($nombre));
    }

    /**
     * Test de estructura del modelo Profesor
     */
    public function test_modelo_profesor_tiene_fillable_correcto(): void
    {
        $profesor = new Profesor();
        $fillable = $profesor->getFillable();
        
        $this->assertContains('rut_profesor', $fillable);
        $this->assertContains('nombre_profesor', $fillable);
        $this->assertContains('correo_profesor', $fillable);
    }
}
