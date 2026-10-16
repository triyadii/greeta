<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(): View
    {
        $menus = Menu::orderBy('urutan')->get();
        $roles = Role::orderBy('namaRole')->get();
        return view('admin.menus.index', compact('menus', 'roles'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'namaMenu' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'akses' => ['nullable', 'array'],
            'urutan' => ['nullable', 'integer'],
        ]);

        $menu = Menu::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Menu baru berhasil ditambahkan.',
            'data' => $menu,
        ]);
    }

    public function show(string $uuid): JsonResponse
    {
        $menu = Menu::where('uuid', $uuid)->firstOrFail();
        return response()->json([
            'success' => true,
            'data' => $menu,
        ]);
    }

    public function update(Request $request, string $uuid): JsonResponse
    {
        $menu = Menu::where('uuid', $uuid)->firstOrFail();

        $validated = $request->validate([
            'namaMenu' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'akses' => ['nullable', 'array'],
            'urutan' => ['nullable', 'integer'],
        ]);

        $menu->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil diperbarui.',
            'data' => $menu,
        ]);
    }

    public function destroy(string $uuid): JsonResponse
    {
        $menu = Menu::where('uuid', $uuid)->firstOrFail();
        $menu->delete();

        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil dihapus.',
        ]);
    }
}
