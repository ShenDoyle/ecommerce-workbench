<?php

namespace Workspace\DataImport\Providers;

use Illuminate\Support\ServiceProvider;

class DataImportServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }
}
