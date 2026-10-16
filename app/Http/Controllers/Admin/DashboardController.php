<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Portfolio;
use App\Models\Quotation;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = now()->toDateString();
        $startOfMonth = now()->startOfMonth()->toDateString();

        // Metrik Pengunjung
        $totalVisitors = Visitor::count(); // Total unique IP per day records
        $visitorsToday = Visitor::where('visit_date', $today)->count();
        $visitorsThisMonth = Visitor::where('visit_date', '>=', $startOfMonth)->count();

        // Metrik Konten
        $totalPortfolios = Portfolio::count();
        $totalNews = News::count();
        $totalQuotations = Quotation::count();
        $pendingQuotations = Quotation::where('status', 'baru')->count();

        // 7 Hari Terakhir untuk grafik
        $last7Days = collect(range(6, 0))->map(function ($daysBack) {
            $date = now()->subDays($daysBack)->toDateString();
            $label = Carbon::parse($date)->translatedFormat('d M');
            $count = Visitor::where('visit_date', $date)->count();

            return [
                'date' => $date,
                'label' => $label,
                'count' => $count,
            ];
        });

        // 5 Pengunjung Terkini
        $recentVisitors = Visitor::orderBy('created_at', 'desc')->take(6)->get();

        // 5 Penawaran Terkini
        $recentQuotations = Quotation::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalVisitors',
            'visitorsToday',
            'visitorsThisMonth',
            'totalPortfolios',
            'totalNews',
            'totalQuotations',
            'pendingQuotations',
            'last7Days',
            'recentVisitors',
            'recentQuotations'
        ));
    }
}
