<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminRouteTest extends TestCase
{
    public function test_admin_route_returns_successful_response(): void
    {
        $response = $this->get('/admin');

        $response->assertStatus(200);
    }
}
