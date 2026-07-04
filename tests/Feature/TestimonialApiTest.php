<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestimonialApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_testimonial_via_api(): void
    {
        $response = $this->postJson('/api/testimonials', [
            'prenom' => 'Alice',
            'nom' => 'Durand',
            'message' => 'Excellent service',
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('prenom', 'Alice')
            ->assertJsonPath('nom', 'Durand');
    }
}
