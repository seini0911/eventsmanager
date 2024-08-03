<?php

namespace App\Providers;

use \App\Repositories\Api\EventRepositoryInterface;
use App\Repositories\Api\EventRepositoryImplementation;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EventRepositoryInterface::class, EventRepositoryImplementation::class);
    }

    /**
     * Bootstrap services.
     */
    // public function boot(): void
    // {
    //     //
    // }
}
