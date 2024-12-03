<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateNivelControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    # php artisan test --filter=CreateNivelControllerTest::test_example
    public function test_create_nivel(): void
    {
        $response = $this->post('/api/niveis', [
            'nivel' => 'NIVEL TESTE'
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id', 'nivel'
        ]);
    }
}
