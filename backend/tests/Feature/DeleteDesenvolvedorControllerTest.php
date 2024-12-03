<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteDesenvolvedorControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    # php artisan test --filter=DeleteDesenvolvedorControllerTest::test_example
    public function test_example(): void
    {
        $response = $this->delete('/api/desenvolvedores/1');

        $response->assertStatus(200);
    }
}
