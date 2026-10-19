<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class DeployFeatureTest extends TestCase
{
    public function test_storage_link_route_executes_and_returns_view(): void
    {
        $response = $this->get('/storage-link');

        $response->assertStatus(200);
        $response->assertSee('Storage Link Runner');
        $response->assertSee('BERHASIL (SUCCESS)');
        $response->assertSee('MODE FOLDER FISIK AKTIF');
    }

    public function test_run_storage_link_alias_route_works(): void
    {
        $response = $this->get('/run-storage-link');

        $response->assertStatus(200);
        $response->assertSee('Storage Link Runner');
        $response->assertSee('BERHASIL (SUCCESS)');
    }

    public function test_optimize_clear_route_executes_and_returns_view(): void
    {
        Artisan::shouldReceive('call')
            ->once()
            ->with('optimize:clear')
            ->andReturn(0);

        Artisan::shouldReceive('output')
            ->once()
            ->andReturn('Clearing cached bootstrap files.');

        $response = $this->get('/optimize-clear');

        $response->assertStatus(200);
        $response->assertSee('Optimize &amp; Cache Clear Runner', false);
        $response->assertSee('Clearing cached bootstrap files.');
        $response->assertSee('BERHASIL (SUCCESS)');
        $response->assertSee('/storage-link');
    }

    public function test_git_pull_route_does_not_throw_fatal_error(): void
    {
        $response = $this->get('/git-pull');

        $this->assertContains($response->getStatusCode(), [200, 500]);
        $response->assertSee('Git Pull Deployment Runner');
        $response->assertSee('/optimize-clear');
        $response->assertSee('/storage-link');
    }
}
