<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
class DomPDFServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->register(\Barryvdh\DomPDF\ServiceProvider::class);

        // Register the alias for DomPDF
        $loader = AliasLoader::getInstance();
        $loader->alias('Pdf', \Barryvdh\DomPDF\Facade\Pdf::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
