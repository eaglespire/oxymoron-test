<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FallBackRouteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function missing_api_routes_should_return_a_json_404()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/api/missing/route');
        $response->assertStatus(404);
        $response->assertHeader('Content-Type', 'application/json');
        $response->assertJson([
            'message' => 'Not Found.'
        ]);
    }
}
