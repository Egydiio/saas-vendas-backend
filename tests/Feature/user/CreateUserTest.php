<?php

namespace Tests\Feature\user;

use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Perry\BaseTestCase;

class CreateUserTest extends BaseTestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_should_create_user()
    {
        $tenant = Tenant::factory()->create();

        $response = $this->postJson('api/users', [
            'name' => 'João Silva',
            'tenant_id' => $tenant->uuid,
            'email' => 'joao@example.com',
            'role' => 'admin',
            'password' => 'admin'
        ], [
            'Authorization' => env('JWT_SECRET')
        ]);

        $response->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('users', [
            'email' => 'joao@example.com',
            'name' => 'João Silva',
            'tenant_id' => $tenant->uuid,
            'role' => 'admin'
        ]);
    }
}
