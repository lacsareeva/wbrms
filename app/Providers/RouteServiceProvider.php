<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The route middleware aliases for the application.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        'check.user.role' => \App\Http\Middleware\CheckUserRole::class,
    ];

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware(['auth:web', 'check.user.role:web'])
            
                ->group(base_path('routes/auth.php'));

            // Admin routes
            Route::middleware(['auth:admin', 'check.user.role:admin'])
                ->group(base_path('routes/admin-auth.php'));
        });
    }
}
