<?php

namespace Workspace${STUDLY}\Providers;

use Illuminate\Support\ServiceProvider;

class TaskcenterServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }
}
