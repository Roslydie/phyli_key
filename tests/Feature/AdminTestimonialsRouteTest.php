<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminTestimonialsRouteTest extends TestCase
{
    public function test_admin_testimonial_route_returns_admin_shell(): void
    {
        $response = $this->get('/admin/testimonial');

        $response->assertStatus(200);
        $response->assertSee('id="app"', false);
    }
}
