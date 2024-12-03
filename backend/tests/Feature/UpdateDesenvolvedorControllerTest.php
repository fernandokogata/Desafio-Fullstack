<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateDesenvolvedorControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    # php artisan test --filter=UpdateDesenvolvedorControllerTest::test_example
    public function test_example(): void
    {
        $response = $this->put('/api/desenvolvedores', [
            'id' => 1,
            'nivel_id' => 1,
            'nome' => 'novo nome',
            'sexo' => 'F',
            'data_nascimento' => '2001-01-01',
            'hobby' => 'atualizar'
        ]);

        $response->assertStatus(200);
    }
}
