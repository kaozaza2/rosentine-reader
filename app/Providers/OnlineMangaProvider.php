<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class OnlineMangaProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            \App\Contract\Service\OnlineRepositoryClient::class,
            \App\Services\OnlineClientFactory::class,
        );
    }
}
