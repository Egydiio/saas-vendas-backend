<?php

namespace Tests\Feature\tenant;

use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\Perry\BaseTestCase;
use Tests\TestCase;

class CreateTenantTest extends BaseTestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $this
            ->perryHttp()
            ->withHeaders([
                'X-APP-TOKEN' => env('APP_FRONT_TOKEN'),
            ])
            ->withBody([
                'name' => 'Lojas Redes',
            ])
            ->post('api/tenants')
            ->assertStatus(ResponseAlias::HTTP_CREATED);

        $this->assertDatabaseHas('tenants', [
            'name' => 'Lojas Redes',
        ]);
    }
}
