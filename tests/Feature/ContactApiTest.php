<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ContactApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_submit_contact_form(): void
    {
        $payload = [
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '123456789',
            'subject' => 'Test Subject',
            'message' => 'Test message content',
        ];

        $response = $this->postJson('/api/addcontact', $payload);

        $response->assertStatus(201)
            ->assertJsonPath('full_name', 'John Doe')
            ->assertJsonPath('email', 'john@example.com')
            ->assertJsonPath('status', 'new');
    }

    public function test_contact_validation_required_fields(): void
    {
        $response = $this->postJson('/api/addcontact', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['full_name', 'email', 'phone', 'subject', 'message']);
    }

    public function test_authenticated_user_can_list_contacts(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/contacts');

        $response->assertStatus(200)
            ->assertJsonIsArray();
    }

    public function test_authenticated_user_can_view_single_contact(): void
    {
        $user = User::factory()->create();
        
        $contact = \App\Models\Contact::create([
            'full_name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '123456789',
            'subject' => 'Test',
            'message' => 'Test message',
        ]);

        $response = $this->actingAs($user, 'sanctum')->getJson("/api/contacts/{$contact->id}");

        $response->assertStatus(200)
            ->assertJsonPath('id', $contact->id)
            ->assertJsonPath('full_name', 'Test User');
    }

    public function test_authenticated_user_can_update_contact_status(): void
    {
        $user = User::factory()->create();
        
        $contact = \App\Models\Contact::create([
            'full_name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '123456789',
            'subject' => 'Test',
            'message' => 'Test message',
            'status' => 'new',
        ]);

        $response = $this->actingAs($user, 'sanctum')->putJson("/api/contacts/{$contact->id}", [
            'status' => 'read',
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('status', 'read');
    }

    public function test_authenticated_user_can_delete_contact(): void
    {
        $user = User::factory()->create();
        
        $contact = \App\Models\Contact::create([
            'full_name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '123456789',
            'subject' => 'Test',
            'message' => 'Test message',
        ]);

        $response = $this->actingAs($user, 'sanctum')->deleteJson("/api/contacts/{$contact->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
    }
}
