<?php

use Illuminate\Support\Facades\Route;
use Workspace\DataImport\Http\Controllers\DataImportController;

Route::prefix('w/{slug}/api/ecommerce/data-import')
    ->middleware(['web', 'auth', App\Base\Workspace\ResolveWorkspace::class, 'workspace.member', 'workspace.breaker'])
    ->group(function (): void {
        Route::post('/upload', [DataImportController::class, 'upload']);
        Route::get('/jobs', [DataImportController::class, 'jobs']);
        Route::get('/jobs/{id}', [DataImportController::class, 'show']);
    });
