<?php

namespace App\Providers;

use App\Interfaces\Interfaces\SaldoRepositoryInterface;
use App\Repositories\SaldoRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceSaldoProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SaldoRepositoryInterface::class,SaldoRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
