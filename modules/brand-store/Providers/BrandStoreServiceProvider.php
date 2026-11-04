<?php

namespace Workspace\BrandStore\Providers;

use Illuminate\Support\ServiceProvider;

class BrandStoreServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }
}
