<?php

use Workspace\Ecommerce\Http\Controllers\EcommerceController;
use Illuminate\Support\Facades\Route;

Route::prefix('w/{slug}/api/ecommerce')
    ->middleware(['web', 'auth', App\Base\Workspace\ResolveWorkspace::class, 'workspace.member', 'workspace.breaker'])
    ->group(function (): void {
        Route::get('/dashboard', [EcommerceController::class, 'dashboard']);
        Route::get('/brands', [EcommerceController::class, 'brands']);
        Route::post('/brands', [EcommerceController::class, 'createBrand']);
    });
