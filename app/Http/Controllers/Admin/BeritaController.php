<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BeritaController extends Controller
{
    public function index(): View
    {
        $news = News::latest()->get();
        return view('admin.berita.index', compact('news'));
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
            'gambar' => ['nullable', 'array', 'max:3'],
            'gambar.*' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ], [
            'judul.required' => 'Judul berita wajib diisi.',
            'gambar.max' => 'Maksimal hanya dapat mengunggah 3 gambar.',
            'gambar.*.image' => 'File harus berupa gambar.',
            'gambar.*.max' => 'Ukuran gambar maksimal 2MB per file.',
        ]);

        $imagePaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                if (count($imagePaths) < 3) {
                    $path = $file->store('news', 'public');
                    $imagePaths[] = $path;
                }
            }
        }

        $newsItem = News::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul) . '-' . Str::random(5),
            'keterangan' => $request->keterangan,
            'gambar' => $imagePaths,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil dipublikasikan.',
            'data' => $newsItem,
        ]);
    }

    public function show(string $uuid): JsonResponse
    {
        $newsItem = News::where('uuid', $uuid)->firstOrFail();
        return response()->json([
            'success' => true,
            'data' => $newsItem,
        ]);
    }

    public function update(Request $request, string $uuid): JsonResponse
    {
        $newsItem = News::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
            'gambar' => ['nullable', 'array'],
            'gambar.*' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'retained_images' => ['nullable', 'array'],
        ]);

        $imagePaths = $request->input('retained_images', []);

        // Hapus file lama yang tidak dipertahankan
        $oldImages = $newsItem->gambar ?? [];
        foreach ($oldImages as $oldImg) {
            if (!in_array($oldImg, $imagePaths)) {
                Storage::disk('public')->delete($oldImg);
            }
        }

        // Tambah file baru
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                if (count($imagePaths) < 3) {
                    $path = $file->store('news', 'public');
                    $imagePaths[] = $path;
                }
            }
        }

        $newsItem->update([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'gambar' => array_values($imagePaths),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil diperbarui.',
            'data' => $newsItem,
        ]);
    }

    public function destroy(string $uuid): JsonResponse
    {
        $newsItem = News::where('uuid', $uuid)->firstOrFail();

        if (!empty($newsItem->gambar)) {
            foreach ($newsItem->gambar as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $newsItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil dihapus.',
        ]);
    }
}
