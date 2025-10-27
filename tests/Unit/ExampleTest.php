<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Test básico de ejemplo.
     */
    public function test_ejemplo_basico(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Test de operaciones matemáticas básicas.
     */
    public function test_operaciones_matematicas(): void
    {
        $suma = 2 + 2;
        $this->assertEquals(4, $suma);
        
        $multiplicacion = 3 * 3;
        $this->assertEquals(9, $multiplicacion);
    }
}
