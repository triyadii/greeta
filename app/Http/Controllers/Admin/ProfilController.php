<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfilController extends Controller
{
    public function index(): View
    {
        $profile = CompanyProfile::first() ?? new CompanyProfile;

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
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp,svg', 'max:2048'],
            'alamatPerusahan' => ['nullable', 'string'],
            'nomorTeleponPerusahaan' => ['nullable', 'string', 'max:50'],
            'emailPerusahaan' => ['nullable', 'email', 'max:255'],
            'websitePerusahaan' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'tiktok' => ['nullable', 'string', 'max:255'],
            'treads' => ['nullable', 'string', 'max:255'],
            'facebook' => ['nullable', 'string', 'max:255'],
        ], [
            'namaPerusahaan.required' => 'Nama perusahaan wajib diisi.',
            'logo.image' => 'File logo harus berupa gambar yang valid.',
            'logo.mimes' => 'Format logo harus jpeg, png, jpg, gif, webp, atau svg.',
            'logo.max' => 'Ukuran file logo maksimal 2MB.',
        ]);

        $profile = CompanyProfile::first();

        if ($request->hasFile('logo')) {
            if ($profile && $profile->logo && Storage::disk('public')->exists($profile->logo)) {
                Storage::disk('public')->delete($profile->logo);
                @unlink(public_path('storage/'.$profile->logo));
            }
            $validated['logo'] = $request->file('logo')->store('company', 'public');

            // Mirror to public/storage for hosting without symlink support
            $dest = public_path('storage/'.$validated['logo']);
            if (! is_link(public_path('storage'))) {
                @mkdir(dirname($dest), 0755, true);
                @copy(storage_path('app/public/'.$validated['logo']), $dest);
                @chmod($dest, 0644);
            }

            // Also mirror as public/favicon.ico for static root requests
            @copy(storage_path('app/public/'.$validated['logo']), public_path('favicon.ico'));
        } elseif ($request->boolean('remove_logo')) {
            if ($profile && $profile->logo && Storage::disk('public')->exists($profile->logo)) {
                Storage::disk('public')->delete($profile->logo);
                @unlink(public_path('storage/'.$profile->logo));
            }
            $validated['logo'] = null;

            // Revert public/favicon.ico to default
            if (file_exists(public_path('assets/media/logos/favicon.ico'))) {
                @copy(public_path('assets/media/logos/favicon.ico'), public_path('favicon.ico'));
            }
        }

        if ($profile) {
            $profile->update($validated);
        } else {
            $profile = CompanyProfile::create($validated);
        }

        return response()->json([
            'success' => true,
            'message' => 'Profil perusahaan dan logo berhasil disimpan.',
            'data' => $profile,
        ]);
    }
}
