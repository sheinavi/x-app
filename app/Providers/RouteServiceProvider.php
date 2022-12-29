<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';
    public const ADMIN = '/admin';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('web')
                ->namespace('App\Http\Controllers')
                ->group(base_path('routes/web.php'));

            Route::prefix('admin')
                ->middleware('web')
                ->namespace('App\Http\Controllers\Admin')
                ->group(base_path('routes/admin.php'));

            Route::prefix('api')
                ->middleware('api')
                ->namespace('App\Http\Controllers\API')
                ->group(base_path('routes/api.php'));

            Route::prefix('tools')
                ->middleware('web')
                ->namespace('App\Http\Controllers\Tools')
                ->group(base_path('routes/tools.php'));

            Route::prefix('games')
                ->middleware('web')
                ->namespace('App\Http\Controllers\Games')
                ->group(base_path('routes/games.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60);
        });
    }
}
