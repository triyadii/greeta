<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\Portfolio;
use App\Models\Visitor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_renders_with_visitor_header_and_data(): void
    {
        Visitor::create([
            'ip_address' => '127.0.0.1',
            'user_agent' => 'PHPUnit Test Browser',
            'visit_date' => now()->toDateString(),
            'visit_count' => 1,
        ]);

        $portfolio = Portfolio::create([
            'namaProject' => 'Healthcare Network Core Pro',
            'keterangan' => 'Modernisasi sistem infrastruktur rumah sakit',
            'gambar' => ['sample.jpg'],
        ]);

        $news = News::create([
            'judul' => 'Inovasi Cloud Enterprise 2026',
            'slug' => 'inovasi-cloud-enterprise-2026',
            'keterangan' => 'Artikel lengkap tentang transformasi digital perusahaan.',
            'gambar' => ['news.jpg'],
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Visitor:');
        $response->assertSee('Healthcare Network Core Pro');
        $response->assertSee('Inovasi Cloud Enterprise 2026');
    }

    public function test_portfolio_page_renders(): void
    {
        Portfolio::create([
            'namaProject' => 'Data Center Deployment XYZ',
            'keterangan' => 'Pengadaan rak server tier 3',
            'gambar' => [],
        ]);

        $response = $this->get('/portofolio');

        $response->assertStatus(200);
        $response->assertSee('Data Center Deployment XYZ');
        $response->assertSee('Visitor:');
    }

    public function test_news_page_and_detail_render(): void
    {
        $news = News::create([
            'judul' => 'Percepatan Adopsi Fiber Optic B2B',
            'slug' => 'percepatan-adopsi-fiber-optic-b2b',
            'keterangan' => 'Ulasan mengenai ekspansi kabel laut dan interkoneksi bisnis.',
            'gambar' => ['fo.jpg'],
        ]);

        $listResponse = $this->get('/berita');
        $listResponse->assertStatus(200);
        $listResponse->assertSee('Percepatan Adopsi Fiber Optic B2B');
        $listResponse->assertSee('Visitor:');

        $detailResponse = $this->get('/berita/' . $news->slug);
        $detailResponse->assertStatus(200);
        $detailResponse->assertSee('Percepatan Adopsi Fiber Optic B2B');
        $detailResponse->assertSee('Ulasan mengenai ekspansi kabel laut');
    }
}
