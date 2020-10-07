<?php

namespace Codemen\Modules\Providers;

use Illuminate\Support\ServiceProvider;
use Codemen\Modules\Contracts\RepositoryInterface;
use Codemen\Modules\Laravel\LaravelFileRepository;

class ContractsServiceProvider extends ServiceProvider
{
    /**
     * Register some binding.
     */
    public function register()
    {
        $this->app->bind(RepositoryInterface::class, LaravelFileRepository::class);
    }
}
