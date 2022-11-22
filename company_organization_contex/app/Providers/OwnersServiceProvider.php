<?php

namespace App\Providers;

use App\Service\GroupByOwnersService;
use App\Service\OwnerServiceInterface;
use Illuminate\Support\ServiceProvider;

class OwnersServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OwnerServiceInterface::class, GroupByOwnersService::class);
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
