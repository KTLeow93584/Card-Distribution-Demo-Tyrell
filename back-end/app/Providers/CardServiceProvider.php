<?php

namespace App\Providers;

use App\Interfaces\CardDistributorInterface;
use App\Services\CardDistributorBaseService;

use Illuminate\Support\ServiceProvider;

/**
 * Service Provider for Card Distribution functionality.
 * 
 * This provider binds the CardDistributorInterface to its concrete implementation
 * CardDistributorBaseService as a singleton in the application container.
 */
class CardServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * 
     * Binds CardDistributorInterface to CardDistributorBaseService as a singleton.
     * This ensures that the same instance of CardDistributorBaseService is used
     * throughout the application when CardDistributorInterface is requested.
     */
    public function register(): void
    {
        $this->app->singleton(CardDistributorInterface::class, CardDistributorBaseService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
