<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FindDesenvolvedoresControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    # php artisan test --filter=FindDesenvolvedoresControllerTest::test_example
    public function test_get_desenvolvedores(): void
    {
        $response = $this->get('/api/desenvolvedores');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'meta' => [
                'total',
                'per_page',
                'current_page',
                'last_page'
            ]
        ]);
    }
}
