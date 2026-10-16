<?php

namespace App\Providers;

use App\Models\CompanyProfile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            try {
                if (Schema::hasTable('company_profiles')) {
                    $companyProfile = CompanyProfile::first();
                    $view->with('companyProfile', $companyProfile);
                }
            } catch (\Throwable $e) {
                // Ignore if DB connection is unavailable during build/migration
            }
        });
    }
}
