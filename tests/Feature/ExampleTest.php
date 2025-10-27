<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Test de ejemplo básico.
     */
    public function test_ejemplo_basico(): void
    {
        // Test simple que siempre pasa para verificar PHPUnit
        $this->assertTrue(true);
    }
    
    /**
     * Test de que la aplicación está configurada correctamente.
     */
    public function test_aplicacion_configurada(): void
    {
        // Verificar que el nombre de la app está configurado
        $this->assertNotEmpty(config('app.name'));
        $this->assertEquals('Laravel', config('app.name'));
    }
}
