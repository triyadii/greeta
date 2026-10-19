<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Show the Metronic login page.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('login');
    }

    /**
     * Handle authentication using Sanctum & Hashed Password verification.
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        // Verifikasi keberadaan user dan kecocokan hash password
        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password yang Anda masukkan salah.',
            ], 422);
        }

        // Login ke session guard
        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        // Buat token Sanctum untuk user
        $token = $user->createToken('admin-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil! Mengalihkan ke dashboard...',
            'redirect' => route('admin.dashboard'),
            'token' => $token,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role?->namaRole ?? 'Staff',
            ],
        ]);
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request): JsonResponse|RedirectResponse
    {
        if ($user = Auth::user()) {
            // Hapus token Sanctum
            $user->tokens()->delete();
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Logout berhasil.',
                'redirect' => route('login'),
            ]);
        }

        return redirect()->route('login');
    }
}
