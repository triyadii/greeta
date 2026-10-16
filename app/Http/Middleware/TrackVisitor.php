<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ignore static assets, internal API checks, and background tasks
        if ($request->is('assets/*') || $request->is('storage/*') || $request->is('up')) {
            return $next($request);
        }

        try {
            $ip = $request->ip() ?? '127.0.0.1';
            $userAgent = $request->userAgent();
            $today = now()->toDateString();

            // Gunakan firstOrCreate untuk mencegah duplikasi IP dalam 1 hari
            Visitor::firstOrCreate(
                [
                    'ip_address' => $ip,
                    'visit_date' => $today,
                ],
                [
                    'user_agent' => $userAgent,
                    'page_visited' => $request->path(),
                    'visit_count' => 1,
                ]
            );
        } catch (\Throwable $e) {
            // Abaikan duplicate key error agar tidak mengganggu response pengguna
        }

        return $next($request);
    }
}
