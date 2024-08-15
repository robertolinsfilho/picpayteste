<?php

namespace App\Providers;

use App\Repositories\UsuarioRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\UsuarioRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UsuarioRepositoryInterface::class, UsuarioRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
