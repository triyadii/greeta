<?php

use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PenawaranController;
use App\Http\Controllers\Admin\PilarController;
use App\Http\Controllers\Admin\PortofolioController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\WilayahController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DeployController;
use App\Http\Controllers\HomeController;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\Route;

// Deployment & Maintenance utility routes (accessible when SSH is not available in production)
Route::controller(DeployController::class)->group(function () {
    Route::get('/git-pull', 'gitPull')->name('deploy.git-pull');
    Route::get('/run-git-pull', 'gitPull');
    Route::get('/migrate', 'migrate')->name('deploy.migrate');
    Route::get('/run-migrate', 'migrate');
    Route::get('/run-seed', 'seed')->name('deploy.seed');
    Route::get('/storage-link', 'storageLink')->name('deploy.storage-link');
    Route::get('/run-storage-link', 'storageLink');
    Route::get('/optimize-clear', 'optimizeClear')->name('deploy.optimize-clear');
    Route::get('/run-optimize-clear', 'optimizeClear');
});

// Serve public storage files directly if symlink fails or is forbidden by web server
Route::get('/storage/{path}', function (string $path) {
    $fullPath = storage_path('app/public/'.$path);
    $basePath = realpath(storage_path('app/public'));
    $realFullPath = realpath($fullPath);

    if (! $realFullPath || ! str_starts_with($realFullPath, $basePath) || is_dir($realFullPath)) {
        abort(404);
    }

    // Auto-mirror to public/storage for future static serving if public/storage is a real folder
    $dest = public_path('storage/'.$path);
    if (! is_link(public_path('storage')) && ! file_exists($dest)) {
        @mkdir(dirname($dest), 0755, true);
        @copy($realFullPath, $dest);
        @chmod($dest, 0644);
    }

    return response()->file($realFullPath);
})->where('path', '.*')->name('storage.fallback');

// Dynamic favicon endpoint matching company profile logo
Route::get('/favicon.ico', function () {
    $profile = CompanyProfile::first();
    if ($profile && ! empty($profile->logo)) {
        if (str_starts_with($profile->logo, 'http://') || str_starts_with($profile->logo, 'https://')) {
            return redirect($profile->logo);
        }
        $storagePath = storage_path('app/public/'.$profile->logo);
        if (file_exists($storagePath)) {
            return response()->file($storagePath);
        }
        $publicPath = public_path('storage/'.$profile->logo);
        if (file_exists($publicPath)) {
            return response()->file($publicPath);
        }
    }

    $fallback = public_path('assets/media/logos/favicon.ico');
    if (file_exists($fallback)) {
        return response()->file($fallback);
    }

    abort(404);
})->name('favicon');

// Public Landing Page, Portfolio Catalog, News, & Inquiry Submission
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/portofolio', [HomeController::class, 'portofolio'])->name('public.portofolio');
Route::get('/berita', [HomeController::class, 'berita'])->name('public.berita');
Route::get('/berita/{slug}', [HomeController::class, 'detailBerita'])->name('public.berita.show');
Route::post('/penawaran', [PenawaranController::class, 'store'])->name('public.penawaran.store');

// Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin panel routes (requires authentication)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 1. Menu & Akses
    Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
    Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/menus/{uuid}', [MenuController::class, 'show'])->name('menus.show');
    Route::put('/menus/{uuid}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('/menus/{uuid}', [MenuController::class, 'destroy'])->name('menus.destroy');

    // 2. Role Akses
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{uuid}', [RoleController::class, 'show'])->name('roles.show');
    Route::put('/roles/{uuid}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{uuid}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // 3. Profil Perusahaan
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::post('/profil', [ProfilController::class, 'storeOrUpdate'])->name('profil.store');
    Route::get('/profil/{uuid}', [ProfilController::class, 'show'])->name('profil.show');

    // 4. Visi & Misi
    Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi.index');
    Route::post('/visi-misi', [VisiMisiController::class, 'store'])->name('visi-misi.store');
    Route::get('/visi-misi/{uuid}', [VisiMisiController::class, 'show'])->name('visi-misi.show');
    Route::put('/visi-misi/{uuid}', [VisiMisiController::class, 'update'])->name('visi-misi.update');
    Route::delete('/visi-misi/{uuid}', [VisiMisiController::class, 'destroy'])->name('visi-misi.destroy');

    // 5. Penawaran
    Route::get('/penawaran', [PenawaranController::class, 'index'])->name('penawaran.index');
    Route::post('/penawaran', [PenawaranController::class, 'store'])->name('penawaran.store');
    Route::get('/penawaran/{uuid}', [PenawaranController::class, 'show'])->name('penawaran.show');
    Route::put('/penawaran/{uuid}', [PenawaranController::class, 'update'])->name('penawaran.update');
    Route::delete('/penawaran/{uuid}', [PenawaranController::class, 'destroy'])->name('penawaran.destroy');

    // 6. Wilayah Operasional
    Route::get('/wilayah', [WilayahController::class, 'index'])->name('wilayah.index');
    Route::post('/wilayah', [WilayahController::class, 'store'])->name('wilayah.store');
    Route::get('/wilayah/{uuid}', [WilayahController::class, 'show'])->name('wilayah.show');
    Route::put('/wilayah/{uuid}', [WilayahController::class, 'update'])->name('wilayah.update');
    Route::delete('/wilayah/{uuid}', [WilayahController::class, 'destroy'])->name('wilayah.destroy');

    // 7. Portofolio
    Route::get('/portofolio', [PortofolioController::class, 'index'])->name('portofolio.index');
    Route::post('/portofolio', [PortofolioController::class, 'store'])->name('portofolio.store');
    Route::get('/portofolio/{uuid}', [PortofolioController::class, 'show'])->name('portofolio.show');
    Route::post('/portofolio/{uuid}', [PortofolioController::class, 'update'])->name('portofolio.update');
    Route::delete('/portofolio/{uuid}', [PortofolioController::class, 'destroy'])->name('portofolio.destroy');

    // 8. Pilar
    Route::get('/pilar', [PilarController::class, 'index'])->name('pilar.index');
    Route::post('/pilar', [PilarController::class, 'store'])->name('pilar.store');
    Route::get('/pilar/{uuid}', [PilarController::class, 'show'])->name('pilar.show');
    Route::put('/pilar/{uuid}', [PilarController::class, 'update'])->name('pilar.update');
    Route::delete('/pilar/{uuid}', [PilarController::class, 'destroy'])->name('pilar.destroy');

    // 9. Berita
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{uuid}', [BeritaController::class, 'show'])->name('berita.show');
    Route::post('/berita/{uuid}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{uuid}', [BeritaController::class, 'destroy'])->name('berita.destroy');

    // 10. Manajemen Visitor
    Route::get('/visitors', [VisitorController::class, 'index'])->name('visitors.index');
    Route::delete('/visitors/{uuid}', [VisitorController::class, 'destroy'])->name('visitors.destroy');
});
