<?php

namespace App\Providers;

use App\Repository\EloquentRepositoryInterface; 
use App\Repository\UserRepositoryInterface; 
use App\Repository\DealersRepositoryInterface;
use App\Repository\VehiclesRepositoryInterface;
use App\Repository\Eloquent\UserRepository; 
use App\Repository\Eloquent\DealersRepository;
use App\Repository\Eloquent\VehiclesRepository;
use App\Repository\Eloquent\BaseRepository; 
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/*
| You create the required class interface and register them with the RepositoryServiceProvider
*/

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(DealersRepositoryInterface::class, DealersRepository::class);
        $this->app->bind(VehiclesRepositoryInterface::class, VehiclesRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
