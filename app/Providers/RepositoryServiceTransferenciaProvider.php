<?php

namespace App\Providers;

use App\Interfaces\Interfaces\TransferenciaRepositoryInterface;
use App\Repositories\TransferenciaRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceTransferenciaProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TransferenciaRepositoryInterface::class,TransferenciaRepository::class);
    }


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
