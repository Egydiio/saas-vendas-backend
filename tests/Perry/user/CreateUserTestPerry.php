<?php

namespace Tests\Perry\user;

use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\Perry\BaseTestCase;

class CreateUserTestPerry extends BaseTestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_shouldCreateUser(): void
    {
        $tenant = Tenant::factory()->create();

        $this
            ->perryHttp()
            ->withHeaders([
                'Authorization' => env('JWT_SECRET')
            ])
            ->withBody([
                'name' => 'João Silva',
                'tenant_id' => $tenant->uuid,
                'email' => 'joao@example.com',
                'role' => 'admin',
                'password' => 'admin'
            ])
            ->post('api/users')
            ->assertStatus(ResponseAlias::HTTP_CREATED);


        $this->assertDatabaseHas('users', [
            'email' => 'joao@example.com',
            'name' => 'João Silva',
            'tenant_id' => $tenant->uuid,
            'role' => 'admin'
        ]);
    }
}
