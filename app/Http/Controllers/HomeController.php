<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\News;
use App\Models\OperationalArea;
use App\Models\Pillar;
use App\Models\Portfolio;
use App\Models\VisionMission;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the main landing page with dynamic data & visitor counters.
     */
    public function index(): View
    {
        $profile = CompanyProfile::first() ?? new CompanyProfile([
            'namaPerusahaan' => 'PT. Gretta Solutions Network',
            'alamatPerusahan' => 'Jalan Ujung Serdang, Kec. Tanjung Morawa, Kab. Deli Serdang, Sumatera Utara',
            'nomorTeleponPerusahaan' => '+62 853 - 558 - 36787',
            'emailPerusahaan' => 'grettasolutionsnetwork@gmail.com',
            'websitePerusahaan' => 'https://greeta.id',
            'instagram' => '@greeta.id',
            'tiktok' => '@greeta.id',
            'treads' => '@greeta.id',
            'facebook' => 'PT Gretta Solutions Network',
        ]);

        $visionMission = VisionMission::latest()->first() ?? new VisionMission([
            'visi' => 'Menjadi penyedia solusi teknologi informasi, infrastruktur jaringan, dan integrasi sistem enterprise terdepan di Indonesia.',
            'misi' => "1. Menghadirkan infrastruktur telekomunikasi dan jaringan berkinerja tinggi serta berkehandalan tinggi.\n2. Memberikan layanan solusi digital cerdas terpadu bagi sektor kesehatan, korporasi, dan industri.\n3. Menyediakan dukungan teknis purna jual yang proaktif dengan standar SLA enterprise.",
        ]);

        $pillars = Pillar::all();
        $areas = OperationalArea::all();
        $portfolios = Portfolio::latest()->take(6)->get();
        $news = News::latest()->take(3)->get();

        $totalVisitors = Visitor::count();
        $todayVisitors = Visitor::where('visit_date', now()->toDateString())->count();

        return view('welcome', compact(
            'profile',
            'visionMission',
            'pillars',
            'areas',
            'portfolios',
            'news',
            'totalVisitors',
            'todayVisitors'
        ));
    }

    /**
     * Display public Portfolio catalog page.
     */
    public function portofolio(Request $request): View
    {
        $profile = CompanyProfile::first();
        $query = Portfolio::latest();

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('namaProject', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        $portfolios = $query->paginate(9);
        $totalVisitors = Visitor::count();
        $todayVisitors = Visitor::where('visit_date', now()->toDateString())->count();

        return view('portofolio.index', compact('portfolios', 'profile', 'totalVisitors', 'todayVisitors'));
    }

    /**
     * Display public News list page.
     */
    public function berita(Request $request): View
    {
        $profile = CompanyProfile::first();
        $query = News::latest();

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        $news = $query->paginate(6);
        $totalVisitors = Visitor::count();
        $todayVisitors = Visitor::where('visit_date', now()->toDateString())->count();

        return view('berita.index', compact('news', 'profile', 'totalVisitors', 'todayVisitors'));
    }

    /**
     * Display single news article.
     */
    public function detailBerita(string $slug): View
    {
        $profile = CompanyProfile::first();
        $item = News::where('slug', $slug)->firstOrFail();
        $recentNews = News::where('id', '!=', $item->id)->latest()->take(4)->get();
        $totalVisitors = Visitor::count();
        $todayVisitors = Visitor::where('visit_date', now()->toDateString())->count();

        return view('berita.show', compact('item', 'recentNews', 'profile', 'totalVisitors', 'todayVisitors'));
    }
}
