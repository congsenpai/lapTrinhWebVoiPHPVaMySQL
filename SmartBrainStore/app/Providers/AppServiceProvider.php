<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route as Route;


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
// app/Providers/RouteServiceProvider.php

public function boot()
{
    // Đăng ký route middleware
    $this->registerRouteMiddleware();
    
    // Các cấu hình khác
}

protected function registerRouteMiddleware()
{
    Route::aliasMiddleware('check.role', \App\Http\Middleware\CheckRole::class);
}

}
