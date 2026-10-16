<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisitorController extends Controller
{
    public function index(Request $request): View
    {
        $query = Visitor::query();

        if ($date = $request->input('date')) {
            $query->where('visit_date', $date);
        }

        $visitors = $query->orderBy('visit_date', 'desc')->orderBy('created_at', 'desc')->paginate(25);
        $totalUnique = Visitor::count();
        $todayUnique = Visitor::where('visit_date', now()->toDateString())->count();

        return view('admin.visitors.index', compact('visitors', 'totalUnique', 'todayUnique'));
    }

    public function destroy(string $uuid): JsonResponse
    {
        $visitor = Visitor::where('uuid', $uuid)->firstOrFail();
        $visitor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Catatan log pengunjung berhasil dihapus.',
        ]);
    }
}
