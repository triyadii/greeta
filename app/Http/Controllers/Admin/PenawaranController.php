<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PenawaranController extends Controller
{
    public function index(): View
    {
        $quotations = Quotation::latest()->get();
        return view('admin.penawaran.index', compact('quotations'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'namaPIC' => ['required', 'string', 'max:255'],
            'namaPerusahaan' => ['required', 'string', 'max:255'],
            'nomorTelepon' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'jenisKebutuhan' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'in:baru,diproses,selesai'],
        ]);

        $quotation = Quotation::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Penawaran berhasil disimpan.',
            'data' => $quotation,
        ]);
    }

    public function show(string $uuid): JsonResponse
    {
        $quotation = Quotation::where('uuid', $uuid)->firstOrFail();
        return response()->json([
            'success' => true,
            'data' => $quotation,
        ]);
    }

    public function update(Request $request, string $uuid): JsonResponse
    {
        $quotation = Quotation::where('uuid', $uuid)->firstOrFail();

        $validated = $request->validate([
            'namaPIC' => ['required', 'string', 'max:255'],
            'namaPerusahaan' => ['required', 'string', 'max:255'],
            'nomorTelepon' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'jenisKebutuhan' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'status' => ['required', 'string', 'in:baru,diproses,selesai'],
        ]);

        $quotation->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data penawaran berhasil diperbarui.',
            'data' => $quotation,
        ]);
    }

    public function destroy(string $uuid): JsonResponse
    {
        $quotation = Quotation::where('uuid', $uuid)->firstOrFail();
        $quotation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Penawaran berhasil dihapus.',
        ]);
    }
}
