<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_usuarios_get(): void
    {
        $response = $this->get('/api/usuarios');

        $response->assertStatus(200);
    }


    public function test_transferencias_get(): void
    {
        $response = $this->get('/api/transferencias');

        $response->assertStatus(200);
    }

    public function test_saldo_get(): void
    {
        $response = $this->get('/api/saldos');

        $response->assertStatus(200);
    }
}
