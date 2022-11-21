<?php

namespace App\Providers;

use App\Repository\EloquentRepositoryInterface; 
use App\Repository\UserRepositoryInterface; 
use App\Repository\DealersRepositoryInterface;
use App\Repository\Eloquent\UserRepository; 
use App\Repository\Eloquent\DealersRepository; 
use App\Repository\Eloquent\BaseRepository; 
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/*
| You create the required class interface and register them with the RepositoryServiceProvider
*/

class RouteServiceProvider extends ServiceProvider
{
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

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
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
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
