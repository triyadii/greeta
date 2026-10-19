<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pillar;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PilarController extends Controller
{
    public function index(): View
    {
        $pillars = Pillar::all();

        return view('admin.pilar.index', compact('pillars'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'namaPilar' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ], [
            'namaPilar.required' => 'Nama pilar layanan wajib diisi.',
        ]);

        $pillar = Pillar::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pilar layanan berhasil ditambahkan.',
            'data' => $pillar,
        ]);
    }

    public function show(string $uuid): JsonResponse
    {
        $pillar = Pillar::where('uuid', $uuid)->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $pillar,
        ]);
    }

    public function update(Request $request, string $uuid): JsonResponse
    {
        $pillar = Pillar::where('uuid', $uuid)->firstOrFail();

        $validated = $request->validate([
            'namaPilar' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $pillar->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pilar layanan berhasil diperbarui.',
            'data' => $pillar,
        ]);
    }

    public function destroy(string $uuid): JsonResponse
    {
        $pillar = Pillar::where('uuid', $uuid)->firstOrFail();
        $pillar->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pilar layanan berhasil dihapus.',
        ]);
    }
}
