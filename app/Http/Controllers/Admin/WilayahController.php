<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OperationalArea;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WilayahController extends Controller
{
    public function index(): View
    {
        $areas = OperationalArea::latest()->get();
        return view('admin.wilayah.index', compact('areas'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'namaWilayah' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ], [
            'namaWilayah.required' => 'Nama wilayah operasional wajib diisi.',
        ]);

        $area = OperationalArea::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Wilayah operasional berhasil ditambahkan.',
            'data' => $area,
        ]);
    }

    public function show(string $uuid): JsonResponse
    {
        $area = OperationalArea::where('uuid', $uuid)->firstOrFail();
        return response()->json([
            'success' => true,
            'data' => $area,
        ]);
    }

    public function update(Request $request, string $uuid): JsonResponse
    {
        $area = OperationalArea::where('uuid', $uuid)->firstOrFail();

        $validated = $request->validate([
            'namaWilayah' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $area->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Wilayah operasional berhasil diperbarui.',
            'data' => $area,
        ]);
    }

    public function destroy(string $uuid): JsonResponse
    {
        $area = OperationalArea::where('uuid', $uuid)->firstOrFail();
        $area->delete();

        return response()->json([
            'success' => true,
            'message' => 'Wilayah operasional berhasil dihapus.',
        ]);
    }
}
