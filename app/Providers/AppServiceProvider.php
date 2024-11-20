<?php

namespace App\Providers;

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
        require_once __DIR__ . '/../Helper.php';
        $website_language = Setting("website_language");
        if (!$website_language || $website_language == "both") {
            $website_language = "en";
        }
        session(['language' => $website_language]);
    }
}
