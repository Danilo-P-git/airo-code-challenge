<?php

namespace App\Providers;

use App\Interfaces\QuotationRepositoryInterface;
use App\Repositories\QuotationRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(QuotationRepositoryInterface::class, QuotationRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
