<?php

namespace Tests\Feature;

use App\Models\CompanyProfile;
use App\Models\Role;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminCrudTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $role = Role::firstOrCreate(['namaRole' => 'Superadmin']);
        $this->user = User::firstOrCreate(
            ['email' => 'admin@greeta.id'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'),
                'role_id' => $role->id,
            ]
        );
    }

    public function test_login_authenticates_with_sanctum_and_hashed_password(): void
    {
        $response = $this->postJson('/login', [
            'email' => 'admin@greeta.id',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true])
            ->assertJsonStructure(['token', 'redirect', 'user']);

        $this->assertAuthenticatedAs($this->user);
    }

    public function test_visitor_tracking_middleware_logs_only_once_per_day_per_ip(): void
    {
        $testIp = '203.0.113.45';

        // First visit
        $this->withServerVariables(['REMOTE_ADDR' => $testIp])
            ->get('/');

        $this->assertEquals(1, Visitor::where('ip_address', $testIp)->count());

        // Second visit same day same IP
        $this->withServerVariables(['REMOTE_ADDR' => $testIp])
            ->get('/');

        // Should STILL be 1 (no duplicate)
        $this->assertEquals(1, Visitor::where('ip_address', $testIp)->count());
    }

    public function test_menu_crud(): void
    {
        $this->actingAs($this->user);

        // Create
        $response = $this->postJson(route('admin.menus.store'), [
            'namaMenu' => 'Test Menu Baru',
            'url' => '/admin/test',
            'icon' => 'ki-duotone ki-test',
            'akses' => ['Superadmin'],
            'urutan' => 99,
        ]);
        $response->assertStatus(200)->assertJson(['success' => true]);
        $uuid = $response->json('data.uuid');

        // Show
        $this->getJson(route('admin.menus.show', $uuid))
            ->assertStatus(200)
            ->assertJson(['success' => true]);

        // Update
        $this->putJson(route('admin.menus.update', $uuid), [
            'namaMenu' => 'Test Menu Updated',
            'url' => '/admin/test-updated',
        ])->assertStatus(200)->assertJson(['success' => true]);

        // Delete
        $this->deleteJson(route('admin.menus.destroy', $uuid))
            ->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    public function test_role_crud(): void
    {
        $this->actingAs($this->user);

        $response = $this->postJson(route('admin.roles.store'), [
            'namaRole' => 'Role Testing Khusus',
        ]);
        $response->assertStatus(200)->assertJson(['success' => true]);
        $uuid = $response->json('data.uuid');

        $this->putJson(route('admin.roles.update', $uuid), [
            'namaRole' => 'Role Testing Edited',
        ])->assertStatus(200)->assertJson(['success' => true]);

        $this->deleteJson(route('admin.roles.destroy', $uuid))
            ->assertStatus(200)->assertJson(['success' => true]);
    }

    public function test_company_profile_update_and_logo_upload(): void
    {
        Storage::fake('public');
        $this->actingAs($this->user);

        $fakeLogo = UploadedFile::fake()->image('company_logo.png', 200, 200);

        // Upload new logo and details
        $response = $this->post(route('admin.profil.store'), [
            'namaPerusahaan' => 'PT Gretta Solutions Network Automated Test',
            'nomorTeleponPerusahaan' => '081234567890',
            'emailPerusahaan' => 'info@greeta.test',
            'websitePerusahaan' => 'https://greeta.test',
            'logo' => $fakeLogo,
        ], ['Accept' => 'application/json']);

        $response->assertStatus(200)->assertJson(['success' => true]);

        $profile = CompanyProfile::first();
        $this->assertNotNull($profile->logo);
        Storage::disk('public')->assertExists($profile->logo);
        $this->assertStringContainsString('storage/'.$profile->logo, $profile->logo_url);
        $this->assertStringContainsString('storage/'.$profile->logo, $profile->favicon_url);

        // Reset/remove logo
        $responseRemove = $this->post(route('admin.profil.store'), [
            'namaPerusahaan' => 'PT Gretta Solutions Network Automated Test',
            'remove_logo' => '1',
        ], ['Accept' => 'application/json']);

        $responseRemove->assertStatus(200)->assertJson(['success' => true]);
        $profile->refresh();
        $this->assertNull($profile->logo);
        $this->assertEquals(CompanyProfile::DEFAULT_LOGO, $profile->logo_url);
        $this->assertStringContainsString('favicon.ico', $profile->favicon_url);
    }

    public function test_pages_render_profile_favicon(): void
    {
        // Public home landing page
        $homeResponse = $this->get(route('home'));
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('rel="shortcut icon"', false);
        $homeResponse->assertSee('rel="icon"', false);

        // Login page
        $loginResponse = $this->get(route('login'));
        $loginResponse->assertStatus(200);
        $loginResponse->assertSee('rel="shortcut icon"', false);

        // Favicon route responds
        $faviconResponse = $this->get('/favicon.ico');
        $this->assertTrue(in_array($faviconResponse->getStatusCode(), [200, 302]));
    }

    public function test_deployment_routes_accessible_without_auth(): void
    {
        // 1. Git pull route responds with HTML runner
        $gitResponse = $this->get('/git-pull');
        $this->assertStringContainsString('Git Pull Deployment Runner', $gitResponse->getContent());

        // 2. Migrate route runs artisan migrate and responds with HTML runner
        $migrateResponse = $this->get('/migrate');
        $migrateResponse->assertStatus(200);
        $this->assertStringContainsString('Database Migration Runner', $migrateResponse->getContent());

        // 3. Run-seed route runs artisan seed
        $seedResponse = $this->get('/run-seed');
        $seedResponse->assertStatus(200);
        $this->assertStringContainsString('Database Seeder Runner', $seedResponse->getContent());
    }

    public function test_vision_mission_crud(): void
    {
        $this->actingAs($this->user);

        $response = $this->postJson(route('admin.visi-misi.store'), [
            'visi' => 'Menjadi pemimpin solusi IT terpercaya.',
            'misi' => "1. Kualitas terbaik\n2. Layanan prima",
        ]);
        $response->assertStatus(200)->assertJson(['success' => true]);
        $uuid = $response->json('data.uuid');

        $this->deleteJson(route('admin.visi-misi.destroy', $uuid))
            ->assertStatus(200)->assertJson(['success' => true]);
    }

    public function test_quotation_public_submission_and_admin_management(): void
    {
        // Public consultation submission
        $response = $this->postJson(route('public.penawaran.store'), [
            'namaPIC' => 'Ir. Hendra',
            'namaPerusahaan' => 'RS Harapan Kita',
            'nomorTelepon' => '081299998888',
            'email' => 'hendra@rshk.test',
            'jenisKebutuhan' => 'Smart Surveillance CCTV',
            'deskripsi' => 'Pengadaan 50 titik kamera IP AI',
        ]);
        $response->assertStatus(200)->assertJson(['success' => true]);
        $uuid = $response->json('data.uuid');

        // Admin updates status
        $this->actingAs($this->user);
        $this->putJson(route('admin.penawaran.update', $uuid), [
            'namaPIC' => 'Ir. Hendra',
            'namaPerusahaan' => 'RS Harapan Kita',
            'nomorTelepon' => '081299998888',
            'status' => 'diproses',
        ])->assertStatus(200)->assertJson(['success' => true]);

        // Delete
        $this->deleteJson(route('admin.penawaran.destroy', $uuid))
            ->assertStatus(200)->assertJson(['success' => true]);
    }

    public function test_operational_area_crud(): void
    {
        $this->actingAs($this->user);

        $res = $this->postJson(route('admin.wilayah.store'), [
            'namaWilayah' => 'Sumatera Bagian Utara',
            'keterangan' => 'Medan, Deli Serdang, Binjai',
        ]);
        $res->assertStatus(200)->assertJson(['success' => true]);
        $uuid = $res->json('data.uuid');

        $this->deleteJson(route('admin.wilayah.destroy', $uuid))
            ->assertStatus(200)->assertJson(['success' => true]);
    }

    public function test_pillar_crud(): void
    {
        $this->actingAs($this->user);

        $res = $this->postJson(route('admin.pilar.store'), [
            'namaPilar' => 'Pilar Infrastruktur Enterprise',
            'keterangan' => 'Layanan jaringan andal dan stabil',
        ]);
        $res->assertStatus(200)->assertJson(['success' => true]);
        $uuid = $res->json('data.uuid');

        $this->deleteJson(route('admin.pilar.destroy', $uuid))
            ->assertStatus(200)->assertJson(['success' => true]);
    }

    public function test_portfolio_with_images_up_to_3(): void
    {
        Storage::fake('public');
        $this->actingAs($this->user);

        $file1 = UploadedFile::fake()->image('project1.jpg');
        $file2 = UploadedFile::fake()->image('project2.jpg');

        $res = $this->postJson(route('admin.portofolio.store'), [
            'namaProject' => 'Instalasi Jaringan Rumah Sakit',
            'keterangan' => 'Implementasi fiber optic backbone 10Gbps',
            'gambar' => [$file1, $file2],
        ]);

        $res->assertStatus(200)->assertJson(['success' => true]);
        $uuid = $res->json('data.uuid');
        $this->assertCount(2, $res->json('data.gambar'));

        // Delete
        $this->deleteJson(route('admin.portofolio.destroy', $uuid))
            ->assertStatus(200)->assertJson(['success' => true]);
    }

    public function test_news_with_images_up_to_3(): void
    {
        Storage::fake('public');
        $this->actingAs($this->user);

        $file = UploadedFile::fake()->image('news1.jpg');

        $res = $this->postJson(route('admin.berita.store'), [
            'judul' => 'Peluncuran Layanan Cloud Gretta',
            'keterangan' => 'Inovasi cloud hosting bersertifikasi Tier 3',
            'gambar' => [$file],
        ]);

        $res->assertStatus(200)->assertJson(['success' => true]);
        $uuid = $res->json('data.uuid');
        $this->assertNotEmpty($res->json('data.slug'));

        // Delete
        $this->deleteJson(route('admin.berita.destroy', $uuid))
            ->assertStatus(200)->assertJson(['success' => true]);
    }
}
