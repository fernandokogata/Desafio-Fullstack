<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateDesenvolvedorControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    # php artisan test --filter=CreateDesenvolvedorControllerTest::test_example
    public function test_example(): void
    {
        $response = $this->post('/api/desenvolvedores', [
            'nivel_id' => 1,
            'nome' => 'DEV TESTE',
            'sexo' => 'M',
            'data_nascimento' => '1979-01-01',
            'hobby' => 'TOCAR VIOLÃO'
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'nome',
            'sexo',
            'data_nascimento',
            'hobby'
        ]);
    }
}
