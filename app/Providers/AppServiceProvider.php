<?php

namespace App\Providers;

use App\Helpers\AuthHelper;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Force HTTPS link generation when running in production
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Share authenticated user data with all views
        View::composer('*', function ($view) {
            $view->with('authUser', AuthHelper::getAuthenticatedUser());
        });
    }
}
