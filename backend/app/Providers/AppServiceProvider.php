<?php

namespace App\Providers;

use App\Domain\Repositories\NivelRepositoryInterface;
use App\Infrastructure\Repositories\EloquentNivelRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(NivelRepositoryInterface::class, EloquentNivelRepository::class);
    }

    public function boot(): void
    {
        date_default_timezone_set('America/Sao_Paulo');
    }
}
