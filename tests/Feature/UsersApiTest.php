<?php

namespace Tests\Feature;

use App\Models\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_manage_users_via_api(): void
    {
        $user = Users::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'secret123',
        ]);

        $response = $this->getJson('/api/users');
        $response->assertOk()
            ->assertJsonFragment(['email' => $user->email]);

        $response = $this->postJson('/api/users', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => 'strong-password',
        ]);

        $response->assertCreated()
            ->assertJsonPath('name', 'Jane Doe')
            ->assertJsonMissingPath('password');

        $this->assertDatabaseHas('users', ['email' => 'jane@example.com']);

        $createdUser = Users::where('email', 'jane@example.com')->firstOrFail();

        $response = $this->putJson('/api/users/'.$createdUser->id, [
            'name' => 'Jane Smith',
        ]);

        $response->assertOk()
            ->assertJsonPath('name', 'Jane Smith');

        $response = $this->deleteJson('/api/users/'.$createdUser->id);
        $response->assertOk();

        $this->assertDatabaseMissing('users', ['id' => $createdUser->id]);
    }
}
