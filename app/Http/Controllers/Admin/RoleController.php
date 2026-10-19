<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::withCount('users')->orderBy('namaRole')->get();

        return view('admin.roles.index', compact('roles'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'namaRole' => ['required', 'string', 'max:255', 'unique:roles,namaRole'],
        ], [
            'namaRole.required' => 'Nama role wajib diisi.',
            'namaRole.unique' => 'Nama role sudah terdaftar.',
        ]);

        $role = Role::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Role berhasil ditambahkan.',
            'data' => $role,
        ]);
    }

    public function show(string $uuid): JsonResponse
    {
        $role = Role::where('uuid', $uuid)->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $role,
        ]);
    }

    public function update(Request $request, string $uuid): JsonResponse
    {
        $role = Role::where('uuid', $uuid)->firstOrFail();

        $validated = $request->validate([
            'namaRole' => ['required', 'string', 'max:255', 'unique:roles,namaRole,'.$role->id],
        ], [
            'namaRole.required' => 'Nama role wajib diisi.',
            'namaRole.unique' => 'Nama role sudah terdaftar.',
        ]);

        $role->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Role berhasil diperbarui.',
            'data' => $role,
        ]);
    }

    public function destroy(string $uuid): JsonResponse
    {
        $role = Role::where('uuid', $uuid)->firstOrFail();

        if ($role->users()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Role tidak dapat dihapus karena masih digunakan oleh pengguna.',
            ], 422);
        }

        $role->delete();

        return response()->json([
            'success' => true,
            'message' => 'Role berhasil dihapus.',
        ]);
    }
}
