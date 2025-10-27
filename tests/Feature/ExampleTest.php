<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Test de la ruta principal.
     */
    public function test_ruta_principal_responde(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
