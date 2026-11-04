<?php

namespace Workspace${STUDLY}\Providers;

use Illuminate\Support\ServiceProvider;

class InventorylogisticsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }
}
