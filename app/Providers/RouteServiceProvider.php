<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $authNamespace = 'App\\Http\\Controllers\\Auth';
    protected $adminApiNamespace = 'App\\Http\\Controllers\\API\\Admin';
    protected $userApiNamespace = 'App\\Http\\Controllers\\API\\User';
    protected $openApiNamespace = 'App\\Http\\Controllers\\API\\Open';

    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
    }

    public function map()
    {
        $this->mapAuthRoutes();
        $this->mapOpenApiRoutes();
        $this->mapUserApiRoutes();
        $this->mapAdminApiRoutes();
    }

    protected function mapAuthRoutes()
    {
        Route::middleware(['api'])
            ->namespace($this->authNamespace)
            ->group(base_path('/routes/api/auth.php'));
    }

    protected function mapOpenApiRoutes()
    {
        Route::middleware(['api'])
            ->namespace($this->openApiNamespace)
            ->group(base_path('/routes/api/open.php'));
    }

    protected function mapUserApiRoutes()
    {
        Route::prefix('api/v1')
            ->middleware(['api', 'auth'])
            ->namespace($this->userApiNamespace)
            ->group(base_path('routes/api/user.php'));
    }

    protected function mapAdminApiRoutes()
    {
        Route::prefix('api/v1/admin')
            ->middleware(['api', 'auth'])
            ->namespace($this->adminApiNamespace)
            ->name('admin.')
            ->group(base_path('/routes/api/admin.php'));
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
