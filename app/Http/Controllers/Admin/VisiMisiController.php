<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisionMission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisiMisiController extends Controller
{
    public function index(): View
    {
        $visionMissions = VisionMission::latest()->get();
        return view('admin.visi-misi.index', compact('visionMissions'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'visi' => ['required', 'string'],
            'misi' => ['required', 'string'],
        ], [
            'visi.required' => 'Visi perusahaan wajib diisi.',
            'misi.required' => 'Misi perusahaan wajib diisi.',
        ]);

        $item = VisionMission::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data Visi & Misi berhasil disimpan.',
            'data' => $item,
        ]);
    }

    public function show(string $uuid): JsonResponse
    {
        $item = VisionMission::where('uuid', $uuid)->firstOrFail();
        return response()->json([
            'success' => true,
            'data' => $item,
        ]);
    }

    public function update(Request $request, string $uuid): JsonResponse
    {
        $item = VisionMission::where('uuid', $uuid)->firstOrFail();

        $validated = $request->validate([
            'visi' => ['required', 'string'],
            'misi' => ['required', 'string'],
        ]);

        $item->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data Visi & Misi berhasil diperbarui.',
            'data' => $item,
        ]);
    }

    public function destroy(string $uuid): JsonResponse
    {
        $item = VisionMission::where('uuid', $uuid)->firstOrFail();
        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Visi & Misi berhasil dihapus.',
        ]);
    }
}
