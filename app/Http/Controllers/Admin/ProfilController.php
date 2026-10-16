<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfilController extends Controller
{
    public function index(): View
    {
        $profile = CompanyProfile::first() ?? new CompanyProfile();
        return view('admin.profil.index', compact('profile'));
    }

    public function show(string $uuid): JsonResponse
    {
        $profile = CompanyProfile::where('uuid', $uuid)->firstOrFail();
        return response()->json([
            'success' => true,
            'data' => $profile,
        ]);
    }

    public function storeOrUpdate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'namaPerusahaan' => ['required', 'string', 'max:255'],
            'alamatPerusahan' => ['nullable', 'string'],
            'nomorTeleponPerusahaan' => ['nullable', 'string', 'max:50'],
            'emailPerusahaan' => ['nullable', 'email', 'max:255'],
            'websitePerusahaan' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'tiktok' => ['nullable', 'string', 'max:255'],
            'treads' => ['nullable', 'string', 'max:255'],
            'facebook' => ['nullable', 'string', 'max:255'],
        ]);

        $profile = CompanyProfile::first();

        if ($profile) {
            $profile->update($validated);
        } else {
            $profile = CompanyProfile::create($validated);
        }

        return response()->json([
            'success' => true,
            'message' => 'Profil perusahaan berhasil disimpan.',
            'data' => $profile,
        ]);
    }
}
