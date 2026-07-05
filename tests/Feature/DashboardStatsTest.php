<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Contact;
use App\Models\Testimonial;
use App\Models\Users;

class DashboardStatsTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_get_dashboard_stats(): void
    {
        $user = User::factory()->create();

        // Create some test data
        Contact::create([
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '123456789',
            'subject' => 'Test',
            'message' => 'Test message',
            'status' => 'new',
        ]);

        Contact::create([
            'full_name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '987654321',
            'subject' => 'Test 2',
            'message' => 'Test message 2',
            'status' => 'read',
        ]);

        Users::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        Testimonial::create([
            'prenom' => 'Alice',
            'nom' => 'Smith',
            'message' => 'Great service!',
            'published' => true,
        ]);

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/dashboard-stats');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'contacts' => ['total', 'new', 'read', 'closed', 'this_month'],
                'users' => ['total', 'this_month'],
                'testimonials' => ['total', 'published', 'unpublished', 'this_month'],
                'charts' => ['contacts_by_day', 'contacts_by_status'],
                'recent_contacts' => [],
            ])
            ->assertJsonPath('contacts.total', 2)
            ->assertJsonPath('contacts.new', 1)
            ->assertJsonPath('contacts.read', 1)
            ->assertJsonPath('testimonials.total', 1)
            ->assertJsonPath('testimonials.published', 1);
    }

    public function test_unauthenticated_user_cannot_get_dashboard_stats(): void
    {
        $response = $this->getJson('/api/dashboard-stats');

        $response->assertStatus(401);
    }
}
