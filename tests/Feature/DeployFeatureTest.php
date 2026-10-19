<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class DeployFeatureTest extends TestCase
{
    public function test_storage_link_route_executes_and_returns_view(): void
    {
        Artisan::shouldReceive('call')
            ->once()
            ->with('storage:link')
            ->andReturn(0);

        Artisan::shouldReceive('output')
            ->once()
            ->andReturn('The [public/storage] link has been connected to [storage/app/public].');

        $response = $this->get('/storage-link');

        $response->assertStatus(200);
        $response->assertSee('Storage Link Runner');
        $response->assertSee('The [public/storage] link has been connected');
        $response->assertSee('BERHASIL (SUCCESS)');
    }

    public function test_run_storage_link_alias_route_works(): void
    {
        Artisan::shouldReceive('call')
            ->once()
            ->with('storage:link')
            ->andReturn(0);

        Artisan::shouldReceive('output')
            ->once()
            ->andReturn('The links have been created.');

        $response = $this->get('/run-storage-link');

        $response->assertStatus(200);
        $response->assertSee('Storage Link Runner');
    }
}
