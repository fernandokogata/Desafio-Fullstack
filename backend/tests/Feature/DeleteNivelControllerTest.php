<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteNivelControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    # php artisan test --filter=DeleteNivelControllerTest::test_example
    public function test_example(): void
    {
        $response = $this->delete('/api/niveis/1');

        $response->assertStatus(200);
    }
}
