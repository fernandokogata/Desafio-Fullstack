<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateNivelControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    # php artisan test --filter=UpdateNivelControllerTest::test_example
    public function test_example(): void
    {
        $response = $this->get('/api/niveis', [
            'id' => 1,
            'nivel' => 'novo_nivel'
        ]);

        $response->assertStatus(200);
    }
}
