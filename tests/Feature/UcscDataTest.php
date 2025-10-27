<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UcscDataTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test de endpoint de carga automática de datos UCSC
     */
    public function test_endpoint_carga_automatica_existe(): void
    {
        $response = $this->postJson('/api/ucsc/carga-automatica');
        
        // Verificar que el endpoint responde (puede ser 200, 422, etc.)
        $this->assertNotEquals(404, $response->status());
    }

    /**
     * Test de endpoint de consulta de registros
     */
    public function test_endpoint_registros_responde(): void
    {
        $response = $this->getJson('/api/ucsc/registros');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data'
        ]);
    }

    /**
     * Test de endpoint de logs del sistema
     */
    public function test_endpoint_logs_responde(): void
    {
        $response = $this->getJson('/api/ucsc/logs');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data'
        ]);
    }
}
