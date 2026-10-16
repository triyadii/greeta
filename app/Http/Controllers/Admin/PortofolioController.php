<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PortofolioController extends Controller
{
    public function index(): View
    {
        $portfolios = Portfolio::latest()->get();
        return view('admin.portofolio.index', compact('portfolios'));
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'namaProject' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
            'gambar' => ['nullable', 'array', 'max:3'],
            'gambar.*' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ], [
            'namaProject.required' => 'Nama project wajib diisi.',
            'gambar.max' => 'Maksimal hanya dapat mengunggah 3 gambar.',
            'gambar.*.image' => 'File harus berupa gambar.',
            'gambar.*.max' => 'Ukuran gambar maksimal 2MB per file.',
        ]);

        $imagePaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                if (count($imagePaths) < 3) {
                    $path = $file->store('portfolios', 'public');
                    $imagePaths[] = $path;
                }
            }
        }

        $portfolio = Portfolio::create([
            'namaProject' => $request->namaProject,
            'keterangan' => $request->keterangan,
            'gambar' => $imagePaths,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Portofolio proyek berhasil disimpan.',
            'data' => $portfolio,
        ]);
    }

    public function show(string $uuid): JsonResponse
    {
        $portfolio = Portfolio::where('uuid', $uuid)->firstOrFail();
        return response()->json([
            'success' => true,
            'data' => $portfolio,
        ]);
    }

    public function update(Request $request, string $uuid): JsonResponse
    {
        $portfolio = Portfolio::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'namaProject' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
            'gambar' => ['nullable', 'array'],
            'gambar.*' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'retained_images' => ['nullable', 'array'],
        ]);

        $imagePaths = $request->input('retained_images', []);

        // Hapus file lama yang tidak dipertahankan
        $oldImages = $portfolio->gambar ?? [];
        foreach ($oldImages as $oldImg) {
            if (!in_array($oldImg, $imagePaths)) {
                Storage::disk('public')->delete($oldImg);
            }
        }

        // Tambah file baru
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                if (count($imagePaths) < 3) {
                    $path = $file->store('portfolios', 'public');
                    $imagePaths[] = $path;
                }
            }
        }

        $portfolio->update([
            'namaProject' => $request->namaProject,
            'keterangan' => $request->keterangan,
            'gambar' => array_values($imagePaths),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Portofolio berhasil diperbarui.',
            'data' => $portfolio,
        ]);
    }

    public function destroy(string $uuid): JsonResponse
    {
        $portfolio = Portfolio::where('uuid', $uuid)->firstOrFail();

        // Hapus file gambar dari storage
        if (!empty($portfolio->gambar)) {
            foreach ($portfolio->gambar as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $portfolio->delete();

        return response()->json([
            'success' => true,
            'message' => 'Portofolio berhasil dihapus.',
        ]);
    }
}
